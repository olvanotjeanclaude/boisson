<div class="main-menu material-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="user-profile">
        <div class="user-info text-center pb-2"><img class="user-img img-fluid rounded-circle w-25 mt-2"
                src="../../../app-assets/images/portrait/medium/avatar-m-1.png" alt="" />
            <div class="name-wrapper d-block dropdown mt-1"><a class="white dropdown-toggle ml-2" id="user-account"
                    href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                        class="user-name text-capitalize">{{ auth()->user()->full_name }}</span></a>
                <div class="text-light">{{ auth()->user()->permission_access }}</div>
                <div class="dropdown-menu arrow">
                    <a class="dropdown-item">
                        <i class="material-icons align-middle mr-1">person</i>
                        <span class="align-middle">Profile</span>
                    </a>
                    <a class="dropdown-item">
                        <i class="material-icons align-middle mr-1">settings</i>
                        <span class="align-middle">Réglages</span>
                    </a>
                    <a class="dropdown-item">
                        <i class="material-icons align-middle mr-1">power_settings_new</i>
                        <span class="align-middle">Se déconnecter</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu-content text-capitalize">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a href="/admin">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title" data-i18n="">Dashboard</span>
                </a>
            </li>

            <li class=" navigation-header">
                <span data-i18n="nav.category.ecommerce">Mon Magasin</span>
                <i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right"
                    data-original-title="Ecommerce">more_horiz</i>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.utlisateurs.index') }}">
                    <span class="material-icons">people</span>
                    <span class="menu-title">Ulitisateurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.fournisseurs.index') }}">
                    <span class="material-icons">real_estate_agent</span>
                    <span class="menu-title">Fournisseur</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.category-articles.index') }}">
                    <span class="material-icons">category</span>
                    <span class="menu-title">Catégorie D'Articles</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="#">
                    <i class="material-icons">content_paste</i>
                    <span class="menu-title">Approvisionnement</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('admin.approvisionnement.articles.index') }}">
                            <i class="material-icons"></i>
                            <span>Articles</span>
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('admin.approvisionnement.consignations.index') }}">
                            <i class="material-icons"></i>
                            <span>Consignation </span>
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('admin.approvisionnement.packages.index') }}">
                            <i class="material-icons"></i>
                            <span>Groupe d'article</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.articles.index') }}">
                    <span class="material-icons">liquor</span>
                    <span class="menu-title">Document D' Articles</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.ventes.index') }}">
                    <span class="material-icons">
                        shopping_basket
                    </span>
                    <span class="menu-title">Document De Ventes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.clients.index') }}">
                    <span class="material-icons">groups</span>
                    <span class="menu-title">Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.achat-fournisseurs.index') }}">
                    <span class="material-icons">account_balance</span>
                    <span class="menu-title">Achat Fournisseurs</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.factures.index') }}">
                    <span class="material-icons">article</span>
                    <span class="menu-title">Factures</span>
                </a>
            </li>
        </ul>
    </div>
</div>
