<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cat;
use App\Prop;
use App\Product;
use App\Order;
use App\Comment;
use App\Img;



class ClientController extends Controller
{
	public function index()
    {   
        $p = new Product;
		session_start();
		$cats = Cat::all();
        $prods = $p->limit(6)->get();
		return view('client.index',['cats' => $cats,'prods' => $prods,]);

	}
    public function cartShow()
    {   
	 return view('client.cart');
    }


    public function categorySidebar($id)
    {
    	$prods = Product::where('category_id',$id)->get();
    	$props = Prop::where('categ_id',$id)->get();
        $propsN = Prop::where('categ_id',$id)->get('title'); 
    	return [ 'cats'=>$id,
    			'prods' =>$prods, 
                'props' => $props,
                'propsN' =>$propsN,
    		];
    }

    

    public function products(Request $request,$id_cat)
    {   
        $cat = Cat::find($id_cat);
        $prods = Product::where('category_id',$id_cat);
        if ($request->from == NULL) {
            $request->from = $prods->min('price');
        }
        if ($request->to == NULL) {
            $request->to = $prods->max('price');
        }
        if  ($request->has('from') or $request->has('to')) {
            $prods->whereBetween('price',[$request->from,$request->to]);
        }
        if ($request->sort == 'expensive') {
            $prods->orderBy('price','desc');
        } else if ($request->sort == 'cheap') {
            $prods->orderBy('price','asc');
        }
        if ($request->has('propsId')) {
            $prods->join('props','products.id','=','props.product_id')->where('props.description','=',$request->propsId)->select('products.*');
        }
        
    	
        $prods = $prods->paginate(15);
    	return view('client.products',['cat' => $cat,'prods' => $prods]);

    }


    public function loginPage()
    {
    	return view('client.loginPage');
    }

    

    public function test()
    {
    		$prod = Product::all();
    		$cats = Cat::all();
    		return [
                'var1' => $prod,
    			'var2' =>$cats
    				];
    	}


    public function singleProduct($id)
    {
        $img = new Img;
        $comments = Comment::where('prod_id',$id)->get();
    	$prod = Product::find($id);
    	$category = Cat::where('id',$prod->category_id)->get();
    	$props = Prop::where('product_id',$id)->get();
        $imgs = $img->where('product_id',$id)->get();
    	return view('client.singleProd',['cat' => $category['0'],'prod' => $prod,'props' => $props,'comments' => $comments,'imgs' => $imgs]);
    	    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product) {
 
            abort(404);
 
        }
 
        $cart = session()->get('cart');
 
        // if cart is empty then this the first product
        if(!$cart) {
 
            $cart = [
                    $id => [
                        "name" => $product->name,
                        "quantity" => 1,
                        "brand" => $product->brand,
                        "price" => $product->price,
                        "category" => $product->category_id,
                        
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
 
            $cart[$id]['quantity']++;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
 
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "brand" => $product->brand,
            "price" => $product->price,
            "category" => $product->category_id,
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

 	public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
 
            $cart[$request->id]["quantity"] = $request->quantity;
 
            session()->put('cart', $cart);
 
            session()->flash('success', 'Cart updated successfully');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
        else var_dump('asda');
    }   

    public function purchase()
    {
        return view('client.purchase');
    }

    public function order(Request $request)
    {
        $count = count(session('cart'));
        $order = new Order;
        $name = $request->name;
        $secname = $request->secname;
        $email = $request->email;
        $adress = $request->adress;
        $phone = $request->phone;
        $comment = $request->comment;
        $delivery = $request->delivery;
        $this->validate($request, [
            'name' => 'required|',
            'secname' => 'required',
            'email' => 'required',
            'adress' => 'required',
            'phone' => 'required',
            'comment' => 'required',
            'delivery' => 'required',
        ]);
                foreach (session('cart') as $id => $details) {         
                $sub = $details['price'] * $details['quantity'];
                $order->insert([
                    'name' => $name,
                    'secname' => $secname,
                    'email' => $email,
                    'adress' => $adress,
                    'phone' => $phone,
                    'comment' => $comment,
                    'prod_id' => $id,
                    'prod_name' => $details['name'],
                    'prod_quantity' =>$details['quantity'], 
                    'prod_price' => $details['price'],
                    'prod_subtotal' => $sub,
                    'delivery' => $delivery,
                ]);
        }
      session()->forget('cart');  
      return redirect()->route('thx');
    }
    public function thx()
    {
        return view('client.thx');
    }

    public function postComment(Request $request,$id)
    {   
        $name = $request->name;
        $comment = $request->comment;
        $this->validate($request, [
            'name' => 'required',
            'comment' => 'required',
        ]);
        $comment = Comment::insert([
            'name' => $name,
            'text' => $comment,
            'prod_id' => $id,
        ]);

        return redirect()->route('single',$id);
    }

    public function aboutUs()
    {
        return view('client.aboutUs');
    }

    public function search(Request $request)
    {   $prod = new Product;
        $name = '%'.$request->search.'%';
        if ($request->has('search')) {
            $prods = $prod->where('name','like',$name)->get();
        }
        if ($request->has('id')) {
          $prods = $prod->where('brand',$request->id)->get();
        }
        
        return view('client.search',['prods' => $prods]);
    }

}
