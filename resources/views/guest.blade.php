@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-header">Guest {{ __('Dashboard') }}</div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif

               @if ($flag == 'true')
                  Thank you for submitting form
               @else
                  <div class="container">
                     <div class="card-body">
                        <form method="POST" action="{{ route('guestform') }}">
                           @csrf
                           @for ($i = 0; $i < count($fields); $i++)
                           @php
                           $p = json_decode($fields[$i]['properties']);

                           $type = "textbox";
                           $others = '';
                           if ($p[0] == 'email') {
                              $type = "email";
                           }
                           else if ($p[0] == 'min') {
                              $others = "minlength = 4";
                           }
                           else if ($p[0] == 'min') {
                              $others = "maxlength = 10";
                           }
                           else if ($p[0] == 'min') {
                              $others = "required";
                           }

                           $name = $fields[$i]['name'];
                           $nameField = strtolower(str_replace(" ", "_", $name));
                           @endphp
                           <div class="copy_test"></div>
                           <div class="form-group row after-add-more-test">
                              <label for="textbox" class="col-md-4 col-form-label text-md-right">{{$fields[$i]['name']}}</label>
                              <div class="col-md-3">
                                 


                                 <input type="{{$type}}" {{$others}} class="form-control @error('texbox') is-invalid @enderror" name="{{$nameField}}" value="" {{$p[0]}} autofocus>
                                 @error('email')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                              
                           
                           </div>
                           
                           
                           @endfor

                        
                           <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                 <button type="submit" class="btn btn-primary">
                                 {{ __('Submit') }}
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
