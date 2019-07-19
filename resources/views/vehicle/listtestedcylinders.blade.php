@extends('layouts.cngapploggedin')
@section('lefttree')
                    <ul class='wraplist'>   

                    <!--    <li class='menusection'>Main</li>

                    <?php if (Auth::user()->regtype!="hdip") {?>
                        <li class=""> 
                            <a href="{{ route('dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                    <?php }?> Tested Cylinders -->                   

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


                <section class="wrapper main-wrapper row" style=''>

                    <div class='col-12'>
                        <div class="page-title">

                            <div class="float-left">
                                <!-- PAGE HEADING TAG - START --><h1 class="title">Tested Cylinders</h1><!-- PAGE HEADING TAG - END -->                            </div>

                            <div class="float-right d-none">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="index.html"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <li>
                                        <a href="hos-payments.html">Billing</a>
                                    </li>
                                    <li class="active">
                                        <strong>Payments</strong>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- MAIN CONTENT AREA STARTS -->
                    <!--------------------------form-control-lg----->

                    <div class="row margin-0">
                        <div class="col-lg-9 col-md-12 col-12" >
                            <form id="searchvehicle" method="POST" action="{{route('testedcylinders-search')}}">
                                {{ csrf_field() }}


                               
                            <div class="input-group primary">
                                        <select class="form-control" id="pagesize" name="pagesize">
                                                <option value="10">Page size 10</option>
                                                <option value="50">Page size 50</option>
                                                <option value="100">Page size 100</option>
                                                <option value="500">Page size 500</option>
                                                <option value="1000">Page size 1000</option>

                                        </select>                                                                            
                                        <select class="form-control" id="searchby" name="searchby" 
                                        onclick="setplaceholder()"
                                        >
                                                <option value="BrandName">Brand Name</option>
                                                <option value="Standard">Standard</option>
                                                <option value="SerialNumber">Serial no</option>
                                                <option value="CountryOfOrigin">Country</option>
                                                <option value="Date">Date</option>
                                                <option value="InspectionExpiryDate">Expiry Date</option>
                                                <option value="stickerSerialNo">Sticker No</option>
                                        </select>


                    


                                <input type="text" class="form-control search-page-input" placeholder="Search" value="" placeholder="Search" autocomplete="off" id="searchvalue" name="searchvalue">
                                <span class="input-group-addon" 
                                onclick="event.preventDefault(); document.getElementById('searchvehicle').submit();">   
                                    <span class="arrow"></span>
                                    <i class="fa fa-search"></i>
                                </span>                               



                            </div> <!--<br>-->
                        </form>
                        </div>

                    </div>                    

                    <!-- ------IMPLETMENT SEARCH HERE ----->
          
                    <div class="col-xl-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title float-left">List</h2>
                                <div class="actions panel_actions float-right">
                                    <a class="box_toggle fa fa-chevron-down"></a>
                                    <a class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></a>
                                    <a class="box_close fa fa-times"></a>
                                </div>
                            </header>
                            <div class="content-body" style="font-size: 12px;">    <div class="row">
                                    <div class="col-12">



                               

<!--class open creates background highlight------------------------------------>            
                            
                                
                                
                                
                            


                                        <table class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                            <!--id="example-11" draw with search controlls-->
                                            <thead>
                                               <tr>
                                                <!--<i class="fa fa-chevron-up"></i> -->



                                                 <th><a href="/listlabtestedcylinders/?sort=id">Id</a> </th>
                                                 <th><a href="/listlabtestedcylinders/?sort=LabCTS">Lab</a> </th>
                                                 <th><a href="/listlabtestedcylinders/?sort=BrandName">Brand</a></th>
                                                 <th><a href="/listlabtestedcylinders/?sort=Standard">Standard</a></th>
                                                 <th><a href="/listlabtestedcylinders/?sort=SerialNumber">SerialNo</a></th>
                                                 <th><a href="/listlabtestedcylinders/?sort=method">Method</a></th>
                                                 <th><a href="/listlabtestedcylinders/?sort=CountryOfOrigin">Country</a></th>
                                                 <th><a href="/listlabtestedcylinders/?sort=Date">Date</a></th>
                                                 <th><a href="/listlabtestedcylinders/?sort=InspectionExpiryDate">Expiry</a></th>
                                                 <th><a href="/listlabtestedcylinders/?sort=stickerSerialNo">Sticker</a></th>
                                               </tr>

                                            </thead>


                                            <tbody>


                                                 @foreach ($testedcylinders as $cylinder)                               
                                                   <tr>

<?php if ((Auth::user()->regtype=="hdip" || Auth::user()->regtype=="admin") && Auth::user()->readonly!=1) {?>
<td><a href="{{route('editformfortestedcylinders',$cylinder->id)}}">{{$cylinder->id}}</a></td>
<?php 
} 
else
{
?>
                                               <td>{{$cylinder->id}}</td>
<?php }

?>


                                                     <!--<td><a href="{{route('editformfortestedcylinders',$cylinder->id)}}">{{$cylinder->id}}</a></td>-->
                                                     <td>{{$cylinder->LabCTS}}</td>
                                                     <td>{{$cylinder->BrandName}}</td>
                                                     <td>{{$cylinder->Standard}}</td>
                                                     <td>{{$cylinder->SerialNumber}}

                                                     </td>
                                                     <td>{{$cylinder->method}}</td>                                                        
                                                     <td>{{$cylinder->CountryOfOrigin}}</td>
                                                     <td>{{$cylinder->Date}}</td>
                                        
                                                     <td>{{$cylinder->InspectionExpiryDate}}
<?php 

$date = date('Y-m-d');
if($date > $cylinder->InspectionExpiryDate)
{//its already expired?>
<img id='redflag'  src="../assets/images/redflag.png" style="width:20px;height:20px;border:0;">
<?php } ?>

                                                     </td>
                                                     <td>

                                                      {{$cylinder->stickerSerialNo}}
                                                      
<?php 
if (isset($cylinder->stickerSerialNo)){echo '<br>RegNo: '.$cylinder->Registration_no.'</br>';}
?>                                                     

                                                     </td>


                                                   </tr>
                                                 @endforeach  

                                            </tbody>
                                        </table>
                                        <?=$testedcylinders->render()?>
                                    </div>
                                </div>
                            </div>
                        </section></div>

                    <!-- MAIN CONTENT AREA ENDS -->
                </section>

<script>
    
function setplaceholder() {
  if (document.getElementById("searchby").value=="Date" || document.getElementById("searchby").value=="InspectionExpiryDate") {
        document.getElementById("searchvalue").placeholder="mm/dd/yyyy";
  }
  else
  {
    document.getElementById("searchvalue").placeholder="Search";
  }
}
</script>

@endsection