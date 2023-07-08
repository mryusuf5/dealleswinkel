<x-admin.layout>
    <x-slot name="title">Bestellingen</x-slot>
    <div class="row">
        @foreach($orders as $index => $order)
            <a href="#" class="col-md-4 col-12" data-target="#order-{{$order->id}}" data-toggle="modal">
                <div class="card p-5 text-center">
                    <h3>{{$order->name}}</h3>
                    <h5>{{count($order->orderProducts)}} producten</h5>
                    <small class="text-muted">{{$order->created_at}}</small>
                </div>
            </a>

            <div class="modal fade" id="order-{{$order->id}}" tabindex="-1" role="dialog">
                <form action="{{route("admin.orders.update", $order->id)}}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bestelling van: {{$order->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @php
                                $total = 0;
                                @endphp
                                <h5>Land: {{$order->country}}</h5>
                                <h5>Stad en postcode: {{$order->city . " " . $order->zipcode}}</h5>
                                <h5>Adres: {{$order->address . " " . $order->house_number}}</h5>
                                <h5>Telefoonnummer: {{$order->phone_number}}</h5>
                                <h5>Email: {{$order->email}}</h5>
                                @foreach($order->orderProducts as $orderProduct)
                                    @php
                                    $total += $orderProduct->amount * $orderProduct->products[0]->price;
                                    @endphp
                                    <div class="card p-4">
                                        <img style="height: 150px; object-fit: contain" src="{{asset("img/product/" . $orderProduct->products[0]->image)}}" alt="">
                                        <h5>{{$orderProduct->products[0]->name}}</h5>
                                        <h5>Hoeveelheid: {{$orderProduct->amount}}</h5>
                                        <h5>
                                            Prijs ps.: &euro; {{number_format($orderProduct->products[0]->price, 2, ",",".")}}
                                        </h5>
                                        <h5>Totaal: &euro; {{number_format($orderProduct->amount * $orderProduct->products[0]->price, 2, ",",".")}}</h5>
                                    </div>
                                @endforeach
                                <h4>Totaal: &euro; {{number_format($total, 2, ",", ".")}}</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Opslaan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</x-admin.layout>
