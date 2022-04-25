@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-header">Guest data</div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif

                  <div class="container">
                     <div class="card-body">
                     @for ($i = 0; $i < count($users); $i++)
                     <div class="container">
                        <div class="row">
                           <div class="col">
                              {{$users[$i]['name']}}
                           </div>
                           <div class="col">
                              {{$users[$i]['form']['open']}}
                           </div>
                           <div class="col">
                              @if (!empty($users[$i]['form']['forms']))
                                 @php
                                    $data = json_decode($users[$i]['form']['forms'], true);
                                 @endphp
                                 @if (!empty($data))
                                 @foreach ($data as $key => $d)
                                    {{$key}}: <b>{{$d}}</b> <br />
                                 @endforeach
                                 @endif
                              @endif
                           </div>
                        </div>
                        </div>

                     @endfor
                     </div>
                  </div>

            </div>
         </div>
      </div>
   </div>
</div>
@endsection
