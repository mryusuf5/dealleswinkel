<x-admin.layout>
    <x-slot name="title">{{$productcategory->name}}</x-slot>
    <x-slot name="backRoute">{{route('admin.productcategories.index')}}</x-slot>
    <form action="{{route('admin.productcategories.update', $productcategory->id)}}" method="post"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <input type="text" name="name" value="{{$productcategory->name}}" placeholder="Naam" class="form-control">
        </div>
        <div class="form-group">
            <img src="{{asset("img/category/" . $productcategory->image)}}" height="150">
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <textarea name="description" cols="30" rows="10" dirname="description" placeholder="Beschrijving" class="form-control">{{$productcategory->description}}</textarea>
        </div>
        <input type="submit" value="Opslaan" class="btn btn-primary">
    </form>
    <br>
    <form action="{{route('admin.productcategories.destroy', $productcategory->id)}}" method="post" class="confirmForm">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="Verwijderen">
    </form>
    <hr>
    <h3>Producten</h3>
    <a href="#" data-target="#newProduct" data-toggle="modal" class="btn btn-outline-primary mb-2">Nieuwe product</a>

    <div class="table-responsive">
        <table class="table table-striped" style="width: 1200px;">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Naam</th>
                    <th>Beschrijving</th>
                    <th>Prijs</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productcategory->products as $index => $product)
                    <tr class="text-center">
                        <td>
                            <div class="d-flex gap-2">
                                <img src="{{asset('img/product/' . $product->image)}}" height="100" width="100" style="object-fit: contain">
                                {{$index + 1}}
                            </div>
                        </td>
                        <td>{{Str::limit($product->name, 25)}}</td>
                        <td>{{Str::limit($product->description, 25)}}</td>
                        <td>&euro; {{number_format($product->price, 2, ',', '.')}}</td>
                        <td>
                            <div class="d-flex justify-content-center dropdown">
                                <i class="fa-solid fa-ellipsis-vertical" style="font-size: 1.5rem; cursor: pointer" data-toggle="dropdown"></i>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-success text-center" href="{{route('admin.products.edit', $product->id)}}">Aanpassen</a>
                                    <a href="" class="dropdown-item">
                                        <form action="{{route('admin.products.destroy', $product->id)}}" method="post" class="confirmForm">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="text-danger w-100" style="outline: 0; border: 0; background: transparent;" value="Verwijderen">
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="newProduct" tabindex="-1">
        <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="text" hidden name="category_id" value="{{$productcategory->id}}">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nieuwe product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" placeholder="Naam" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="price" placeholder="Prijs" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Beschrijving"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-admin.layout>
