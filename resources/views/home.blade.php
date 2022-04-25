@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-header">Admin {{ __('Dashboard') }} &nbsp; <a href="/users" >Users</a></div>

            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <div class="container">
                  <div class="card-body">
                     <form method="POST" action="{{ route('adminform') }}">
                        @csrf
                        @for ($i = 0; $i < count($fields); $i++)
                        @php
                        $p = json_decode($fields[$i]['properties']);
                        $labelName = "textbox[$i]";
                        $propertyName = "property[$i]";
                        @endphp
                        <div class="copy_test"></div>
                        <div class="form-group row">
                           <label for="textbox" class="col-md-4 col-form-label text-md-right">{{ __('Texbox Label') }}</label>
                           <div class="col-md-3">
                              <input type="textbox" class="form-control @error('texbox') is-invalid @enderror" name="{{$labelName}}" value="{{ $fields[$i]['name'] }}" required autofocus>
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                           </div>
                           <div class="col-md-3">
                              <select class="select" name="{{$propertyName}}" required>
                                 @if (in_array("required", $p))
                                 <option value="required" selected>Required</option>
                                 @else 
                                 <option value="required">Required</option>
                                 @endif
                                 @if (in_array("min", $p))
                                 <option value="min" selected>Min (4)</option>
                                 @else 
                                 <option value="min">Min (4)</option>
                                 @endif
                                 @if (in_array("max", $p))
                                 <option value="max" selected>Max (10)</option>
                                 @else 
                                 <option value="max">Max (10)</option>
                                 @endif
                                 @if (in_array("email", $p))
                                 <option value="email" selected>Email</option>
                                 @else 
                                 <option value="email">Email</option>
                                 @endif
                                 <option value="">None</option>
                              </select>
                           </div>
                          
                        </div>
                        
                        
                        @endfor

                        <div class="copy">
                            <div class="form-group row control-group">
                                <label for="textbox" class="col-md-4 col-form-label text-md-right">{{ __('Texbox Label') }}</label>
                                <div class="col-md-3">
                                    <input type="textbox" class="form-control @error('texbox') is-invalid @enderror" name="textbox[]" value="" required autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <select class="select" name="property[]">
                                    <option value="">None</option>
                                    <option value="required">Required</option>
                                    <option value="max">Min (4)</option>
                                    <option value="min">Max (10)</option>
                                    <option value="email">Email</option>
                                    
                                    </select>
                                </div>
                                <div class="input-group-btn col-md-1 ">   
                                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>  
                                </div>
                                <div class="input-group-btn col-md-1"> 
                                    @if ($i > 0)
                                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>  
                                    @endif
                                </div>
                            </div>
                           </div>
                        
                        <div id="after-add-more">
                        </div>

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
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script type="text/javascript">  
   $(document).ready(function() {  
   
     $(".add-more").click(function(){   
         var html = $(".copy").html(); 

         $("#after-add-more").after(html);  
     });  
   
     $("body").on("click",".remove",function(){   
         $(this).parents(".control-group").remove();  
     });  
   
   });  
   
</script>
