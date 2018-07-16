@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'Documentation')

@section('page_header')

    <div class="container-fluid">
        <h3 class="page-title">
            <i class="icon-doc-text-inv pr-2"></i> Documentation
        </h3>
    </div>

@stop

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs blue nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">Sellers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">Goods</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panel4" role="tab">Godowns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panel5" role="tab">Purchases</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panel6" role="tab">Site</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panel7" role="tab">Site Transfers</a>
                    </li>
                </ul>
                <!-- Tab panels -->
                <div class="tab-content card">
                    <!--Panel 1-->
                    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
                        <br>
                        <div id="carousel-dashboard" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-dashboard" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-dashboard" data-slide-to="1"></li>
                                <li data-target="#carousel-dashboard" data-slide-to="2"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Dashboard_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Goods and Sites chart</b></h3>
                                    </div>
                                </div>
                                <!--/First slide-->
                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Dashboard_2.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Cost chart</b></h3>
                                    </div>
                                </div>
                                <!--/Second slide-->
                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Dashboard_3.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Active Site Transfers</b></h3>
                                        <p class="black-text">You can check for the active site transfers in here</p>
                                    </div>
                                </div>
                                <!--/Third slide-->
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-dashboard" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-dashboard" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                    </div>
                    <!--/.Panel 1-->
                    <!--Panel 2-->
                    <div class="tab-pane fade" id="panel2" role="tabpanel">
                        <br>
                        <div id="carousel-seller" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-seller" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-seller" data-slide-to="1"></li>
                                <li data-target="#carousel-seller" data-slide-to="2"></li>
                                <li data-target="#carousel-seller" data-slide-to="3"></li>
                                <li data-target="#carousel-seller" data-slide-to="4"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Browse_Seller_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Seller Browsing page</b></h3>
                                    </div>
                                </div>
                                <!--/First slide-->
                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Add_Seller_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Adding new seller page</b></h3>
                                    </div>
                                </div>
                                <!--/Second slide-->
                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Read_Seller_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Viewing a particular seller</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Edit_Seller_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Editing a particular seller</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Delete_Seller_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Deleting a particular seller</b></h3>
                                    </div>
                                </div>
                                <!--/Third slide-->
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-seller" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-seller" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                    </div>
                    <!--/.Panel 2-->
                    <!--Panel 3-->
                    <div class="tab-pane fade" id="panel3" role="tabpanel">
                        <br>
                        <div id="carousel-good" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-good" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-good" data-slide-to="1"></li>
                                <li data-target="#carousel-good" data-slide-to="2"></li>
                                <li data-target="#carousel-good" data-slide-to="3"></li>
                                <li data-target="#carousel-good" data-slide-to="4"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Browse_Good_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Browse Goods page</b></h3>
                                    </div>
                                </div>
                                <!--/First slide-->
                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Add_Good_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Adding new Goods page</b></h3>
                                    </div>
                                </div>
                                <!--/Second slide-->
                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Read_Good_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Viewing a particular good page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Edit_Good_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Editing a particular good page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Delete_Good_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Deleting a particular good page</b></h3>
                                    </div>
                                </div>
                                <!--/Third slide-->
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-good" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-good" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="panel4" role="tabpanel">
                        <br>
                        <div id="carousel-godown" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-godown" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-godown" data-slide-to="1"></li>
                                <li data-target="#carousel-godown" data-slide-to="2"></li>
                                <li data-target="#carousel-godown" data-slide-to="3"></li>
                                <li data-target="#carousel-godown" data-slide-to="4"></li>
                                <li data-target="#carousel-godown" data-slide-to="5"></li>
                                <li data-target="#carousel-godown" data-slide-to="6"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Browse_Godown_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Browse Godowns page</b></h3>
                                    </div>
                                </div>
                                <!--/First slide-->
                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Add_Godown_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Adding new Godowns page</b></h3>
                                    </div>
                                </div>
                                <!--/Second slide-->
                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Read_Godown_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Viewing a particular godown page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Incoming_Godown_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Viewing incoming purchases of a particular godown page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Outgoing_Godown_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Viewing outgoing purchases of a particular godown page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Edit_Godown_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Editing a particular godown page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Delete_Godown_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Deleting a particular godown page</b></h3>
                                    </div>
                                </div>
                                <!--/Third slide-->
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-godown" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-godown" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="panel5" role="tabpanel">
                        <br>
                        <div id="carousel-purchase" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-purchase" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-purchase" data-slide-to="1"></li>
                                <li data-target="#carousel-purchase" data-slide-to="2"></li>
                                <li data-target="#carousel-purchase" data-slide-to="3"></li>
                                <li data-target="#carousel-purchase" data-slide-to="4"></li>
                                <li data-target="#carousel-purchase" data-slide-to="5"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Browse_Purchase_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Browse Purchases page</b></h3>
                                    </div>
                                </div>
                                <!--/First slide-->
                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Add_Purchase_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Adding new Purchases page</b></h3>
                                    </div>
                                </div>
                                <!--/Second slide-->
                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Add_Purchase_2.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Adding new Purchases page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Read_Purchase_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Viewing a particular Purchase page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Edit_Purchase_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Editing a particular Purchases page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Delete_Purchase_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Deleting a particular Purchases page</b></h3>
                                    </div>
                                </div>
                                <!--/Third slide-->
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-purchase" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-purchase" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="panel6" role="tabpanel">
                        <br>
                        <div id="carousel-site" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-site" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-site" data-slide-to="1"></li>
                                <li data-target="#carousel-site" data-slide-to="2"></li>
                                <li data-target="#carousel-site" data-slide-to="3"></li>
                                <li data-target="#carousel-site" data-slide-to="4"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Browse_Site_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Browse Sites page</b></h3>
                                    </div>
                                </div>
                                <!--/First slide-->
                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Add_Site_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Adding new Sites page</b></h3>
                                    </div>
                                </div>
                                <!--/Second slide-->
                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Read_Site_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Viewing a particular site page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Edit_Site_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Editing a particular site page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Delete_Site_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Deleting a particular site page</b></h3>
                                    </div>
                                </div>
                                <!--/Third slide-->
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-site" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-site" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="panel7" role="tabpanel">
                        <br>
                        <div id="carousel-sitetransfer" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-sitetransfer" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-sitetransfer" data-slide-to="1"></li>
                                <li data-target="#carousel-sitetransfer" data-slide-to="2"></li>
                                <li data-target="#carousel-sitetransfer" data-slide-to="3"></li>
                                <li data-target="#carousel-sitetransfer" data-slide-to="4"></li>
                                <li data-target="#carousel-sitetransfer" data-slide-to="5"></li>
                                <li data-target="#carousel-sitetransfer" data-slide-to="6"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Browse_SiteTransfer_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Browse Site Transfers page</b></h3>
                                    </div>
                                </div>
                                <!--/First slide-->
                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Add_SiteTransfer_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Adding new Site Transfers page</b></h3>
                                    </div>
                                </div>
                                <!--/Second slide-->
                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Read_SiteTransfer_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Viewing a particular Site Transfers page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Read_SiteTransfer_2.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Viewing a particular Site Transfers page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Read_SiteTransfer_3.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Viewing a particular Site Transfers page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Edit_SiteTransfer_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Editing a particular Site Transfers page</b></h3>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="view">
                                        <img class="d-block w-100" src="{{ asset('images/Delete_SiteTransfer_1.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-caption">
                                        <h3 class="h3-responsive black-text"><b>Deleting a particular Site Transfers page</b></h3>
                                    </div>
                                </div>
                                <!--/Third slide-->
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-sitetransfer" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-sitetransfer" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                    </div>
                    <!--/.Panel 3-->
                </div>
            </div>
        </div>
    </div>
    

@stop
