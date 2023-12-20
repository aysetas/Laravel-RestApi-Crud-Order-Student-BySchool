<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <a href="" class="brand-logo">
            <img src="{{asset('Back')}}/assets/media/project-logos/1.png" width="80">
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">

            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{route('school.index')}}" class="menu-link menu-center item-menu" >
                        <span class="menu-icon me-0">
                            <i class="fas fa-school icon-2x"></i>
                        </span>
                        <span class="menu-text font-size-h6-sm">Okullar</span>
                    </a>
                </li>
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{route('student.index')}}" class="menu-link item-menu">
                         <span class="menu-icon me-0">
                            <i class="fas fa-users icon-2x"></i>
                         </span>
                         <span class="menu-text font-size-h6-sm">Öğrenciler</span>
                    </a>
                </li>
                <li class="menu-item " aria-haspopup="true">
                    <a href="/horizon" class="menu-link item-menu" target="_blank">
                         <span class="menu-icon me-0">
                             <i class="fas fa-circle icon-2x"></i>
                         </span>
                        <span class="menu-text font-size-h6-sm">Horizon</span>
                    </a>
                </li>
                <li class="menu-item " aria-haspopup="true">
                    <a href="/api/documentation" class="menu-link item-menu" target="_blank">
                         <span class="menu-icon me-0">
                             <i class="fas fa-file-alt icon-2x"></i>
                         </span>
                        <span class="menu-text font-size-h6-sm">Swagger</span>
                    </a>
                </li>
                <li class="menu-item " aria-haspopup="true">
                    <a href="/log-viewer-LksdW" class="menu-link item-menu" target="_blank" >
                          <span class="menu-icon me-0">
                              <i class="fas fa-wrench icon-2x"></i>
                         </span>
                        <span class="menu-text font-size-h6-sm">Logs</span>
                    </a>
                </li>
                <li class="menu-item " aria-haspopup="true">
                    <a href="/telescope" class="menu-link item-menu" target="_blank" >
                          <span class="menu-icon me-0">
                              <i class="fas fa-rocket icon-2x"></i>
                         </span>
                        <span class="menu-text font-size-h6-sm">Telescope</span>
                    </a>
                </li>

            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
