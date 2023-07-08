<x-user.layout>
    <div class="container my-5">
        <form action="{{route('orders.store')}}" method="post" class="row g-4 justify-content-center">
            @csrf
            @method('POST')
            <div class="col-lg-10 col-12 alert alert-success">
                <h4>Please check that you fill out all the fields</h4>
                <h4 class="text-danger">After you have filled everything out, send your name and lastname on whatsapp</h4>
            </div>

            <div class="form-group col-lg-5 col-12">
                <input type="text" value="{{@old('firstname')}}" name="firstname" placeholder="First name" class="form-control">
                @error('firstname')<span class="text-danger">{{$message}}</span>@enderror
            </div>

            <div class="form-group col-lg-5 col-12">
                <input type="text" value="{{@old('lastname')}}" name="lastname" placeholder="Last name" class="form-control">
                @error('lastname')<span class="text-danger">{{$message}}</span>@enderror
            </div>

            <div class="form-group col-lg-5 col-12">
                <input type="email" value="{{@old('email')}}" name="email" placeholder="Email address" class="form-control">
                @error('email')<span class="text-danger">{{$message}}</span>@enderror
            </div>

            <div class="form-group col-lg-5 col-12">
                <input type="email" name="confirm_email" placeholder="Confirm email address" class="form-control">
                @error('confirm_email')<span class="text-danger">{{$message}}</span>@enderror
            </div>

            <div class="form-group col-lg-5 col-12">
                <input type="number" value="{{@old('phone_number')}}" name="phone_number" placeholder="Phone number" class="form-control">
                @error('phone_number')<span class="text-danger">{{$message}}</span>@enderror
            </div>

            <div class="form-group col-lg-5 col-12">
                <select name="country" class="form-select">
                    <option>Select a country</option>
                    <option value="belgium">Belgium</option>
                    <option value="netherlands">Netherlands</option>
                    <option value="germany">Germany</option>
                </select>
                @error('country')<span class="text-danger">{{$message}}</span>@enderror
            </div>

            <div class="form-group col-lg-5 col-12">
                <input type="text" value="{{@old('address')}}" name="address" placeholder="Address" class="form-control">
                @error('address')<span class="text-danger">{{$message}}</span>@enderror
            </div>

            <div class="form-group col-lg-5 col-12">
                <input type="text" value="{{@old('house_number')}}" name="house_number" placeholder="House number" class="form-control">
                @error('house_number')<span class="text-danger">{{$message}}</span>@enderror
            </div>

            <div class="form-group col-lg-5 col-12">
                <input type="text" value="{{@old('zipcode')}}" name="zipcode" placeholder="Zipcode" class="form-control">
                @error('zipcode')<span class="text-danger">{{$message}}</span>@enderror
            </div>

            <div class="form-group col-lg-5 col-12">
                <input type="text" value="{{@old('city')}}" name="city" placeholder="City" class="form-control">
                @error('city')<span class="text-danger">{{$message}}</span>@enderror
            </div>

            <div class="form-group col-lg-5 col-12">
                <button class="btn btn-success w-100" type="submit">Ceckout with Whatsapp <i class="fa-brands fa-whatsapp"></i></button>
            </div>
        </form>
    </div>
</x-user.layout>
