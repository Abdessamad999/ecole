<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
    <a href="{{ url('/dashboard') }}">
        <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Programname </li>

                    <!-- eleves-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#eleves-menu">
                            <div class="pull-left"><i class="fas fa-school"></i><span
                                    class="right-nav-text">eleve</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="eleves-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('eleves.index')}}">list d'eleves</a></li>

                        </ul>
                    </li>
                    <!-- classes-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                            <div class="pull-left"><i class="fa fa-building"></i><span
                                    class="right-nav-text">enseignants</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('enseignants.index')}}">list d'enseignants</a></li>
                        </ul>
                    </li>


                    <!-- matières-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#matières-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                                    class="right-nav-text">matières</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="matières-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('matieres.index')}}">List des matières</a></li>
                        </ul>
                    </li>


                    <!-- cours-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#cours-menu"><i class="fas fa-user-graduate"></i>cours<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                        <ul id="cours-menu" class="collapse">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">Student_information<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Student_information" class="collapse">
                                    <li> <a href="{{route('cours.index')}}">list_cours</a></li>
                                </ul>
                            </li>
                           
                        </ul>
                    </li>



                    <!-- notes-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#notes-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                                    class="right-nav-text">notes</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="notes-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('notes.index')}}">List_notes</a> </li>
                        </ul>
                    </li>


                    <!--  emplois du temps-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="# emplois du temps-menu">
                            <div class="pull-left"><i class="fas fa-user-tie"></i><span
                                    class="right-nav-text"> emplois du temps</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id=" emplois du temps-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('emplois_du_temps.index')}}">list d'emplois du temps</a> </li>
                        </ul>
                    </li>

                  

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
