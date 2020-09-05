            <div class="topSearchCont">
                <div class="registrationFormCont">
                    <form action="{{url('suppliers-list')}}" method="get">
                        
                        <div class="row">
                            <div class="col-sm-7 registrationFormFieldCont">
                                <input type="text" class="form-control input-large" value="{{$filterValues['searchKeywork']}}" name="searchKeywork" 
                                       aria-describedby="basic-addon1" placeholder="Enter company name, city, or a service category" 
                                       id="supplierSearchAutoComplete">
                            </div>
                            <div class="col-sm-3 registrationFormFieldCont">
                                <input type="text" class="form-control input-large" value="{{$filterValues['postal_code']}}" name="postal_code" 
                                       aria-describedby="basic-addon1" placeholder="Postal Code, e.g. V5B 1A5">
                            </div>
                            <div class="col-sm-2 registrationFormFieldCont text-right">
                                <input type="submit" class="btn blackBtn btnWithRightArrow" name='suppliersFilter' value="Search"/>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>