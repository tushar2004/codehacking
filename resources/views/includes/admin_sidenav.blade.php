
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="/admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Users<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('users.index')}}">All Users</a>
                            </li>

                            <li>
                                <a href="{{route('users.create')}}">Create User</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Posts<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('posts.index')}}">All Posts</a>
                            </li>

                            <li>
                                <a href="{{route('posts.create')}}">Create Post</a>
                            </li>

                            <li>
                                <a href="{{route('comments.index')}}">All Commments</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>


                    <li>
                        <!-- <a href="{{route('taxonomy.index')}}"><i class="fa fa-wrench fa-fw"></i>Taxonomy<span class="fa arrow"></span></a> -->
                        <a href="{{route('taxonomy.index')}}"><i class="fa fa-wrench fa-fw"></i>Taxonomy</a>
                        <!-- <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('categories.index')}}">All Categories</a>
                            </li>

                            <li>
                                <a href="{{route('categories.create')}}">Create Category</a>
                            </li>

                        </ul> -->
                        <!-- /.nav-second-level -->
                    </li>


                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Media<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('media.index')}}">All Media</a>
                            </li>

                            <li>
                                <a href="{{route('media.create')}}">Upload Media</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Gallery<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('gallery.galleries')}}">View Galleries</a>
                            </li>
                            <li>
                                <a href="{{route('gallery.index')}}">Create Gallery</a>
                            </li>
                        </ul>
                    </li>

                </ul>


            </div>