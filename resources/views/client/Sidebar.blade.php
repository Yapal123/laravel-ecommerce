 <div id="show">
  <h3 class="text-center">
        Фильтры
      </h3>
          <h4 class="text-center mt-2 "> <hr>Цена</h4>
          <form class=" form-inline " name="formFilter" method="GET" action="{{route('products',$cat->id)}}">
            @csrf
            <label for="from" class="ml-4">От</label>
            <input type="text" id="from" name="from" class="filters " value="{{request()->from}}">
            <label for="to">До</label>
            <input type="text" name="to" id="to" class="filters" value="{{request()->to}}">
        <hr>
      <ul class="list-group mt-3 hov w-100" >
        <h4 class="text-center">
          Характеристики
        </h4>
        <?php 
          $prods = $myVar['prods']->unique('brand');   
          $propsN = $myVar['propsN']->unique('title');   
          $props = $myVar['props']->unique('description');  
        ?>
        @foreach($propsN as $prop)
        <li class="list-group-item ">
            <ul class="navbar-nav ml-4 mt-0 mt-lg-0 mb-0">
             <li class="nav-item">
                <a href="" onclick="return false">{{$prop->title}}</a>
                <?php $prs = $props->where('title',$prop->title); ?>
                <ul class="navbar-nav ml-4 mt-0 mt-lg-0 mb-0">
                  @foreach($prs as $pr)
                  <li class="nav-item">
                    <label  class="form-control">{{$pr->description}} {{$pr->unit}}</label>
                <input class="form-control" type="radio" name="propsId" value="{{$pr->description}}" 
                {{request()->propsId == $pr->description ? 'checked' : ''}}>
                  </li>
                  @endforeach
                </ul>
             </li>
            </ul>
        </li>
       @endforeach
          
          <li class="list-group-item ">
            <ul class="navbar-nav  mt-0 mt-lg-0 mb-0 ">
              <h4>Сортировка</h4>
             <li class="nav-item">
              <select class="form-control" name="sort">
             <option value="cheap" >От дешевых к дорогим</option>
             <option value="expensive" >От дорогих к дешевым
             </li>
             <input type="submit" name="sub" class="form-control btn btn-success float-right mt-3" value="Найти">
            </ul>

        </li>
               </form>
      </ul>

   </div>
        <!-- Button trigger modal -->
<div class="hide mt-3"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
  Фильтры
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
         <div class="row">
           <div class="col-12">
               <h3 class="text-center">
        Фильтры
      </h3>
      <ul class="list-group-flush ">
        <li class="list-group-item ">
          <h4 class="text-center">Цена</h4>
          <form class="form-control form-inline" id="formFilter" action="{{route('products',$cat->id)}}" method="GET" onsubmit="process();">
            <label for="from" >От</label>
            <input type="text" id="from" name="from" class="filters " value="{{request()->from}}">
            <label for="to">До</label>
            <input type="text" name="to" id="to" class="filters" value="{{request()->to}}">
        </li>
      </ul>
      <ul class="list-group  hov" >
        <h4 class=" text-center">
          Характеристики
        </h4>

       @foreach($propsN as $prop)
        <li class="list-group-item ">
            <ul class="navbar-nav ml-4 mt-0 mt-lg-0 mb-0">
             <li class="nav-item">
                <a href="" onclick="return false">{{$prop->title}}</a>
                <?php $prs = $props->where('title',$prop->title); ?>
                <ul class="navbar-nav ml-4 mt-0 mt-lg-0 mb-0">
                  @foreach($prs as $pr)
                  <li class="nav-item">
                    <label  class="form-control">{{$pr->description}} {{$pr->unit}}</label>
                <input class="form-control" type="radio" name="propsId" value="{{$pr->description}}" 
                {{request()->propsId == $pr->description ? 'checked' : ''}}>
                  </li>
                  @endforeach
                </ul>
             </li>
            </ul>
        </li>
       @endforeach
       <li class="list-group-item ">
            <ul class="navbar-nav  mt-0 mt-lg-0 mb-0 ">
              <h4>Сортировка:</h4>
             <li class="nav-item">
              <select class="form-control" name="delivery">
             <option value="cheap" >От дешевых к дорогим</option>
             <option value="expensive" >От дорогих к дешевым</option>
            </select>
             </li>
            
            </ul>

        </li>
      </ul>
           </div>
         </div>
       </div>
      </div>
      <input type="submit" name="popSub" class="btn btn-primary w-100" value="Искать">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>

        </form>
      </div>
    </div>
  </div>
  </div>
</div>
