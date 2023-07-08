<x-user.layout>
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <a href="{{route('productcategories.show', $product->category_id)}}" class="text-success
                    text-decoration-none mt-5 col-12"><i class="fa-solid fa-chevron-left"></i> Back</a>
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" id="productImage"
                             src="{{asset('img/product/' . $product->image)}}" style="height: 400px; object-fit: contain">
                    </div>
                    <div class="d-flex flex-wrap">
                        <img src="{{asset("img/product/" . $product->image)}}" height="75" width="75"
                             style="object-fit: contain" onclick="replaceImage(this)"
                             id="{{$product->image}}">
                        @foreach($product->productimages as $image)
                            <img src="{{asset("img/product/" . $image->image)}}" height="75" width="75"
                                 style="object-fit: contain" onclick="replaceImage(this)"
                                 id="{{$image->image}}">
                        @endforeach
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{$product->name}}</h1>
                            <p class="h3 py-2" id="price">&euro; {{number_format($product->price, 2, ',', '.')}}</p>

                            <h6>Description:</h6>
                            <p>{{$product->description}}</p>
                            <form action="{{route('carts.add')}}" method="post">
                                @csrf
                                @method('POST')
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <input type="text" hidden name="product_id" value="{{$product->id}}">
                                        <input type="number" data-price="{{$product->price}}" id="amount"
                                               class="form-control" placeholder="Amount" value="1" name="amount">
                                        <br>
                                        <button type="submit" class="btn btn-success btn-lg" name="submit"
                                                value="addtocard">Add To Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <h3>Reviews:</h3>
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Write a review
                        </a>
                    </div>
                    <p class="py-2">
                        <span class="list-inline-item text-dark">Rating {{round($productReviewsAverage, 1)}} / 5
                            | {{count($product->reviews)}} Comments</span>
                    </p>
                    @foreach($product->reviews as $review)
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <h4>
                                        {{$review->name}} -
                                        @for($i = 0; $i < $review->score; $i++)
                                            <i class="fa fa-star text-warning"></i>
                                        @endfor
                                    </h4>
                                    @if(Session::get('admin'))
                                        <form action="{{route('reviews.destroy', $review->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    @endif
                                </div>
                                <p class="text-muted">{{$review->created_at}}</p>
                            </div>
                            <p>{{$review->review}}</p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1">
        <form action="{{route('reviews.store')}}" method="post">
        @csrf
        @method('POST')
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{$product->name}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <input type="text" name="product_id" hidden value="{{$product->id}}">
                            <div class="form-group d-flex align-items-center">
                                <label for="">Score (1-5):</label>
                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="score" value="5" />
                                    <label for="star5">5 stars</label>
                                    <input type="radio" id="star4" name="score" value="4" />
                                    <label for="star4">4 stars</label>
                                    <input type="radio" id="star3" name="score" value="3" />
                                    <label for="star3">3 stars</label>
                                    <input type="radio" id="star2" name="score" value="2" />
                                    <label for="star2">2 stars</label>
                                    <input type="radio" id="star1" name="score" value="1" />
                                    <label for="star1">1 star</label>
                                </fieldset>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                            <br>
                            <div class="form-group">
                                <textarea name="review" cols="30" rows="10" class="form-control"
                                          placeholder="Review"></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Write review</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @section('userStyles')
        <style>
            .rating {
                float:left;
                border:none;
            }
            .rating:not(:checked) > input {
                position:absolute;
                top:-9999px;
                clip:rect(0, 0, 0, 0);
            }
            .rating:not(:checked) > label {
                float:right;
                width:1em;
                padding:0 .1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:200%;
                line-height:1.2;
                color:#ddd;
            }
            .rating:not(:checked) > label:before {
                content:'★ ';
            }
            .rating > input:checked ~ label {
                color: #f70;
            }
            .rating:not(:checked) > label:hover, .rating:not(:checked) > label:hover ~ label {
                color: gold;
            }
            .rating > input:checked + label:hover, .rating > input:checked + label:hover ~ label, .rating > input:checked ~ label:hover, .rating > input:checked ~ label:hover ~ label, .rating > label:hover ~ input:checked ~ label {
                color: #ea0;
            }
            .rating > label:active {
                position:relative;
            }
        </style>
    @endsection
    @section('userScripts')
        <script>
            let price = document.querySelector('#price');
            let amount = document.querySelector('#amount');

            amount.addEventListener('change', () => {
                price.innerText = `€ ${(amount.value * amount.dataset.price).toFixed(2)}`;
            })

            let image = document.querySelector("#productImage");

            const replaceImage = (e) => {
                image.src = `http://127.0.0.1:8000/img/product/${e.id}`;
            }
        </script>
    @endsection
</x-user.layout>
