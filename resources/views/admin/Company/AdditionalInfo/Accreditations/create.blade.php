@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
            @else
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
            @endif
        </li>
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url()}}/companies">Companies</a>
            <i class="fa fa-circle"></i>  
            @elseif(Auth::user()->access_level == 4)
            <a href="{{url('company/view')}}">Company</a>
            <i class="fa fa-circle"></i>  
            @else
            <a href="{{url()}}/companies/{{$company->id}}">Companies</a>
            <i class="fa fa-circle"></i>  
            @endif
        </li>
        <li>
            <a href="{{url()}}/companies/info/{{$company->id}}">Additional Information</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Add Accreditation</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light form-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-social-dribbble font-green"></i>  
                    <span class="caption-subject font-green bold uppercase">Select Accreditations</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{url()}}/companies/info/accreditations/save/{{$company->id}}" class="form-horizontal form-row-seperated">
                    <div class="form-body">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="company_id" value="{{$company->id}}">
                        <div class="form-group">
                            <div class="col-md-9">
                                <div class="col-md-3">All</div>
                                <div class="col-md-3">Selected</div>
                                <select multiple="multiple" class="multi-select" id="company_accreditations" name="company_accreditations[]">
                                    @foreach($company->accreditations as $accreditation)
                                        <option selected value="{{$accreditation->accreditation->id}}">{{$accreditation->accreditation->name}}</option>
                                    @endforeach
                                    @foreach($accreditations as $accreditation)
                                        <option value="{{$accreditation->id}}">{{$accreditation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">
                                    <i class="fa fa-check"></i>  Submit</button>
                                <a href="{{url()}}/companies/info/{{$company->id}}" class="btn btn-circle grey-salsa btn-outline">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>
<script>
    /* for show menu active */
    $("#compnay-main-menu").addClass("active");
	$('#compnay-main-menu' ).click();
	$('#conpmay-menu-arrow').addClass('open');
    /* end menu active */
    $( document ).ready(function() {
        $('#company_accreditations').multiSelect();
    });
</script>
@endsection
