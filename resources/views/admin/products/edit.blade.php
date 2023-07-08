<x-admin.layout>
    <x-slot name="title">{{$product->name}}</x-slot>
    <x-slot name="backRoute">{{route('admin.productcategories.edit', $product->productcategories->id)}}</x-slot>
    <form action="{{route('admin.products.update', $product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Naam">
        </div>
        <div class="form-group">
            <img src="{{asset("img/product/" . $product->image)}}" height="150">
            <input type="file" class="form-control" name="image">
        </div>
        <div class="form-group">
            <input type="text" name="price" placeholder="Prijs" class="form-control" value="{{$product->price}}">
        </div>
        <div class="form-group">
            <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Beschrijving">{{$product->description}}</textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Opslaan">
    </form>
    <hr>
    <div class="d-flex flex-wrap">
        @foreach($product->productimages as $image)
            <form action="{{route("admin.productimages.destroy", $image->id)}}" method="post" class="confirmForm mr-2">
                @csrf
                @method("DELETE")
                <img src="{{asset("img/product/" . $image->image)}}" height="150">
                <br>
                <button class="btn btn-danger" type="submit">X</button>
            </form>
        @endforeach
    </div>
    <form action="{{route("admin.productimages.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("POST")
        <input type="file" class="form-control my-2" name="image">
        <input type="text" hidden value="{{$product->id}}" name="product_id">
        <input type="submit" class="btn btn-primary" value="Opslaan">
    </form>
</x-admin.layout>
