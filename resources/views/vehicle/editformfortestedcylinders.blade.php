@extends('layouts.cngappdtpicker')
@section('lefttree')
                    <ul class='wraplist'>   

                        <li class='menusection'>Main</li>

                    <!--<?php if (Auth::user()->regtype!="hdip") {?>
                        <li class=""> 
                            <a href="{{ route('dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                    <?php }?>   -->                  

                        <li class='menusection'>Applications</li>
                        
                        @foreach ($treeitems as $node)

                            <?php  
                            $highlightclass="";
                            if ($node->functionname=="Cylinder Inspection")
                            {
                                $highlightclass="open"; //highlight background
                            } else {$highlightclass="";}

                            ?>
                            <li class="{{$highlightclass}}"> 
                                <a href="/{{$node->routename}}">
                                    <i class="fa {{$node->iconClass}}"></i>
                                    <span class="title">{{$node->functionname}}</span>
                                </a>
                            </li> 

                        @endforeach                        




<!-- left tree categories -------4-lefttreecategories.txt-------------------------------->          
                    </ul>
@endsection

@section('content')
<script src="../assets/js/jquery-3.2.1.min.js" type="text/javascript"></script> 

                <section class="wrapper main-wrapper row" style=''>

                    <div class='col-12'>
                        <div class="page-title">

                            <div class="float-left">
                                <!-- PAGE HEADING TAG - START --><h1 class="title">Test Cylinders Edit</h1><!-- PAGE HEADING TAG - END -->                            </div>

                            <div class="float-right d-none">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="index.html"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <li>
                                        <a href="uni-professors.html">Professors</a>
                                    </li>
                                    <li class="active">
                                        <strong>Add Professor</strong>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <!-- MAIN CONTENT AREA STARTS -->
                    <div class="col-12" >
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title float-left">Test Cylinders</h2>
                                <div class="actions panel_actions float-right">
                                    <a class="box_toggle fa fa-chevron-down"></a>
                                    <a class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></a>
                                    <a class="box_close fa fa-times"></a>
                                </div>
                            </header>
                            <div class="content-body">
                                <div class="form-group row" > <!-- style="border-style: solid;"-->
                                    <form id="savecylinders" action ="{{route('updateformfortestedcylinders',$cylinderdetails[0]->id )}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="col-12" >
                                            <div class="form-group row">

                                                <div class="col-7" > <!--  style="border-style: solid;"-->
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <div class="controls">
                                                                @if(session()->has('message'))
                                                                    <div class="alert alert-success">
                                                                        {{ session()->get('message') }}
                                                                    </div>
                                                                @endif                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <div class="col-6">
                                                            <div class="controls">
                                                            <label class="form-label" >Country of Origin</label>
                                                            </div>
                                                        </div>


                                                        <div class="col-6">
                                                            <div class="controls">

                                                                <select class="form-control" id ="CountryOfOrigin" name="CountryOfOrigin">
                                                                    @foreach ($countries as $country)
                                                                    <option value="<?php echo $country->countries;?>" 

                                                                        <?php if ($country->countries==$cylinderdetails[0]->CountryOfOrigin){echo 'selected';}?>

                                                                        ><?php echo $country->countries;?></option>
                                                                    @endforeach


                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div><!-- end of country origin -->
                                                    <div class="form-group row" >
                                                        <div class="col-6">
                                                            <div class="controls">
                                                            <label class="form-label" >Brand Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="controls">





                                                                <select class="form-control" id ="brand" name="brand">
                                                                    @foreach ($brands as $brand)
                                                                    <option value="<?php echo $brand->brandname;?>"

                                                                    <?php if ($brand->brandname==
                                                                        $cylinderdetails[0]->BrandName){echo 'selected';}?>

                                                                        ><?php echo $brand->brandname;?></option>
                                                                    @endforeach
                                                                </select>                                                                
                                                            </div>                                                
                                                        </div>
                                                    </div> <!-- end of brand name -->


                                                   

                                                    <div class="form-group row" >
                                                        <div class="col-6">
                                                            <div class="controls">
                                                            <label class="form-label" >Stamdard</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="controls">
                                                                <select class="form-control" id="standard"  name="standard" >
                                                                    <option value ="NZ5454" 

                                                                    <?php if ($cylinderdetails[0]->Standard=="NZ5454"){echo 'selected';}?>                                             
                                                                     >NZ5454</option>
                                                                    <option value ="ISO 11439" 

                                                                    <?php if ($cylinderdetails[0]->Standard=="ISO 11439"){echo 'selected';}?>  

                                                                     >ISO 11439</option>
                                                                 </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" >
                                                        <div class="col-6">
                                                            <div class="controls">
                                                            <label class="form-label" >Test Method</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="controls">
                                                                <select class="form-control" id="method"  name="method" >
                                                                    <option value ="Manual" 

                                                                    <?php if ($cylinderdetails[0]->Standard=="Manual"){echo 'selected';}?>                                             
                                                                     >Manual</option>
                                                                    <option value ="Automatic" 

                                                                    <?php if ($cylinderdetails[0]->Standard=="Automatic"){echo 'selected';}?>  

                                                                     >Automatic</option>
                                                                 </select>
                                                            </div>
                                                        </div>
                                                    </div>

               

                                                    <div class="form-group row" >
                                                        <div class="col-6">
                                                            <div class="controls">
                                                            <label class="form-label" >Serial No</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="controls">
                                                                <input type="text" value="{{$cylinderdetails[0]->SerialNumber}}" class="form-control{{ $errors->has('SerialNo') ? ' is-invalid' : '' }}" 
                                                                id="SerialNo" name="SerialNo" placeholder="Serial No" autocomplete="off" 
                                                                >
                                              @if ($errors->has('SerialNo'))
                                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('SerialNo') }}</strong>
                                                </span>
                                              @endif                                                                                                                      
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group row" >
                                                        <div class="col-6">
                                                            <div class="controls">
                                                            <label class="form-label" >Inspection Date</label>
                                                            </div>
                                                        </div> 
                                                        <div class="col-6">



                                                            <div class="controls">
                                                                <input type="text" value="{{date('m/d/Y', strtotime($cylinderdetails[0]->Date))}}" class="form-control{{ $errors->has('edate') ? ' is-invalid' : '' }} datepicker" data-format="mm/dd/yyyy"  id="edate" name="edate" placeholder="date (e.g. 04/03/2015)" autocomplete="off">

                                              @if ($errors->has('edate'))
                                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('edate') }}</strong>
                                                </span>
                                              @endif                                                                                                                      
                                                            </div>
                                                        </div>
                                                    </div>                        
                                                    <div class="form-group row" >
                                                        <div class="col-6">
                                                            <div class="controls">
                                                            <label class="form-label" >Inspection Expiry</label>
                                                            </div>
                                                        </div> 

                                                        
                                                        <div class="col-6">
                                                            <div class="controls">
                                                                <input type="text" value="{{date('m/d/Y', strtotime($cylinderdetails[0]->InspectionExpiryDate))}}" class="form-control" data-format="mm/dd/yyyy" placeholder="Expiry Date" id="expiry" name="expiry" readonly>
                                                            </div>
                                                <input type="hidden" id ="year" name="year">
                                                <input type="hidden" id ="month" name="month">
                                                <input type="hidden" id ="day" name="day">                                                            
                                                        </div>
                                                    </div>   
                                                </div>  <!-- end of left column -->
                                                <div class="col-5" > <!--  style="border-style: solid;"-->
                                                                                                    


                                                    <div class="form-group row">
                                                        <p>&nbsp;</p>
                                                        <div class="col-12" style="height:28em;overflow-y: auto;  background-color:#dddddd;color:black">
                                                            <div class="controls">
                                                                Serial nos added <br>
                                                                 <?php echo  session()->get('registeredcylinders') ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>
                                        </div>


                                        <div class="col-12 col-md-9 col-lg-8 padding-bottom-30">
                                            <div class="text-left">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <!--<button type="button" class="btn">Cancel</button>-->
                                            </div>
                                        </div>                                        
                                    </form>
                                    

                                </div> <!-- end of first body row-->


                            </div>  <!-- end of content body -->
                        </section>
                    </div>  <!-- end of Main Content Area Col12-->
                </section> <!-- end of main wrapper -->



<script>
/*function setexpirydate() {

    var entrydate =document.getElementById("date");
    alert(entrydate.value);

}*/
$(function(){
var expiry =document.getElementById("expiry");
var expiryyear =document.getElementById("year");
var expirymonth =document.getElementById("month");
var expiryday =document.getElementById("day");
    
    
    /*setting expiry at the time of loading the page. this value is in db*/
    var inityear5= new Date(expiry.value);    
     expiryyear.value =inityear5.getFullYear();
     expirymonth.value =inityear5.getMonth() +1; //get month returns value from 0 to 11
     expiryday.value =inityear5.getDate() ;    
    /*setting expiry at the time of loading the page*/

   $(".datepicker").change(function() {
    var addressinput = $(this).val();
    var d = new Date(addressinput); //"03/25/2015"

    var year = d.getFullYear();
    var month = d.getMonth() ;
    var day = d.getDate();
    var year5 = new Date(year + 5, month, day)

     expiryyear.value =year5.getFullYear();
     expirymonth.value =year5.getMonth()+1;
     expiryday.value =year5.getDate() ;
    
    expiry.value=year5.toLocaleDateString();;

    //console.log(year5);
   });

   $(".datepicker").focusout(function() {
    var addressinput = $(this).val();
    var d = new Date(addressinput); //"03/25/2015"

    var year = d.getFullYear();
    var month = d.getMonth();
    var day = d.getDate();
    var year5 = new Date(year + 5, month, day)
//d.toLocaleDateString();
    expiry.value=year5.toLocaleDateString();;
     
     expiryyear.value =year5.getFullYear();
     expirymonth.value =year5.getMonth()+1;
     expiryday.value =year5.getDate() ;    
    //console.log(year5);
    //console.log(addressinput);
   });

});
</script>


@endsection