<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cat;
use App\Prop;
use App\Product;
use App\Order;
use App\Img;

class AdminController extends Controller
{
    public function add(){
        $cat = Cat::all();
    	return view('add',['cats' => $cat]);
    }

    public function store(Request $request)
    {
    	$prod = new Product;
    	$prop = new Prop;
        $img = new Img;
    	$name = $request->name;
    	$brand = $request->brand;
    	$category = $request->category;
    	$price = $request->price;
    	$propTitle = $request->propTitle;
    	$propDesc = $request->propDesc;
    	$propUnit = $request->propUnit;
    	$count = count($_POST['propTitle']);
        $quantity = $request->quantity;
        $description = $request->description;  
        $this->validate($request, [
            'name' => 'required|',
            'brand' => 'required',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'propTitle' => 'required',
            'propDesc' =>'required',
            'propUnit' =>'required',
        ]);
    	$id = $prod->insertGetId(['name' => $name, 'brand' => $brand, 'category_id' => $category,'price' => $price,'count' => $quantity,'descr' => $description]);
    	for($i = 0; $i<$count; $i++ ) {
    		$_propTitle = strtoupper($propTitle[$i]);
    		$_propDesc = strtoupper($propDesc[$i]);
    		$_propUnit = strtoupper($propUnit[$i]);

    		$prop->insert(['title' => $_propTitle,'description' => $_propDesc,'unit' => $_propUnit, 'product_id' => $id,'categ_id' => $category]);
    	}
    	$this->validate($request, [
            'mainImg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

            if ($request->hasFile('mainImg')) {

                $image = $request->file('mainImg');
                $nameImg = $request->name.'.jpg';
                $destinationPath = public_path('/img/products/'.$category);
                $image->move($destinationPath, $nameImg);
                $img->insert(['name' => $nameImg,'product_id' => $id,'main' => 1]);
                }

        if ($request->secondImg) {
            $imgCount = count($request->secondImg);
            $paths = [];
            foreach($request->secondImg as $key => $image) {
             $this->validate($request, [
                'image' => '|image|file|max:2048',
    ]);
            $imageName = $request->name.'_'.$key.'.jpg';
            $image->move(public_path('img/products/'.$category), $imageName);
            $paths[] = $imageName;
            $img->insert(['name' => $imageName,'product_id' => $id]);
        }
     }

    	return back()->with('success', 'Data Your files has been successfully added');
    }

    public function allItems()
    {
        if (!empty($_GET)) {
            var_dump($_GET);
            $getQuery = '%'.$_GET['search'].'%';
            $products = Product::where('name','like',$getQuery)->get();
        } else{
        $products = Product::paginate(20);
        }

        return view('admin.allItems',['prods' => $products]);
    }

    public function deleteItem($id)
    {

        $product = Product::find($id);
        $product->where('id', '=',$id)->delete();
        $prop =  Prop::where('product_id','=',$id)->delete();
        return redirect()->route('allItems');
    }

    public function editItem($id)
    {   
        $img = new Img;
        $prods = Product::find($id);
        $props = Prop::where('product_id','=',$id)->get();
        $imgs = $img->where('product_id','=',$id)->get();
        return view('admin.editItem',['prod' => $prods,'props' => $props,'imgs' => $imgs]);    
    }

    public function updateItem(Request $request)
    {   
        $img = new Img;
        $product = new Product;
        $prop = new Prop;
        $cat = $request->category_id;
        $id = $request->id;
        $count = count($_POST['propTitle']);
        $product->where('id', $id)
          ->update(['name' => $request->name,
                    'brand' => $request->brand,
                    'price' => $request->price,
                    'category_id' =>$cat,
                    'count' => $request->quantity,
                    'descr' => $request->description,
                    ]);
        for ($i=0; $i < $count; $i++) {       
            $prop->where('id', $request->propId[$i])
            ->update([
                    'description' =>$request->propDesc[$i],
                    'categ_id' =>$cat,
                    'title' =>$request->propTitle[$i],
                    'product_id' => $id,
                    'unit' => $request->propUnit[$i],      
                    ]);
          var_dump(($request->propDesc)[$i]."/");
          echo '<br>'.$request->propDesc[$i].'<br>';
   
    }   
     $this->validate($request, [
    'mainImg' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('mainImg')) {
        $image = $request->file('mainImg');
        $name = $request->name.'.jpg';
        $destinationPath = public_path('/img/products/'.$cat);
        $image->move($destinationPath, $name);
        $img->update(['name' => $name,'product_id' => $id,'main' => 1]);
        }

     if ($request->secondImg) {
        $paths = [];
         foreach($request->secondImg as $key => $image) {
             $this->validate($request, [
                'image' => '|image|file|max:2048',
    ]);
            $imageName = $request->name.'_'.$key.'.jpg';
            $image->move(public_path('img/products/'.$cat), $imageName);
            $paths[] = $imageName;
            $img->update([
                'name' => $imageName,
                'product_id' => $id]);
        }
     }
     
        



         
        
        return back()->with('success', 'Data Your files has been successfully added');

    } 
    
    public function allOrders(Request $request)
    {
        $or = new Order;
        if (!empty($request->serach)) {
            $getQuery = '%'.$request->search.'%';
            $ords = Order::where('phone','like',$getQuery)->get();
            $orders = $ords->keyBy('created_at');
        } else{
        $ords = Order::all();
        $orders = Order::groupBy('created_at')->paginate(10);
                }

        return view('admin.allOrders',['orders' => $orders,'ords' => $ords,]);
    }


    public function orderFind($id){
        $prods = new Product;
        $orders = Order::find($id);
        $orderProducts = Order::where('created_at','=',$orders->created_at)->get();
        $orderArray['0'] = $orderProducts;
        $orderArray['1'] = $orders;
        return $orderArray;
    }
    public function singleOrder($id)
    {
        return view('admin.singleOrder',['order' => $this->orderFind($id)['1'],'prodOrders' =>$this->orderFind($id)['0'],]);
    }

    public function editOrder($id)
    {
        return view('admin.editOrder',['order' => $this->orderFind($id)['1'],'prodOrders' =>$this->orderFind($id)['0'],]);
        
    }

    public function updateOrder(Request $request)
    {
        $order = Order::find($request->id);
        Order::where('created_at',$order->created_at)->update([
            'name' => $request->name,
            'secname' => $request->secondName,
            'email' => $request->email,
            'phone' => $request->phone,
            'delivery' => $request->delivery
        ]);
        $count = count($request->quantity);
        for ($i=0; $i < $count ; $i++) { 
            Order::where('created_at',$order->created_at)->update([
            'prod_quantity' => $request->quantity[$i],
            
        ]);

        }
        return redirect()->route('singleOrder',$request->id);
    }
}

