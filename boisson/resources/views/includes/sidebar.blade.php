<div class="main-menu material-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="user-profile">
        <div class="user-info text-center pb-2"><img class="user-img img-fluid rounded-circle w-25 mt-2"
                src="{{ getUserProfile() }}" alt="" />
            <div class="name-wrapper d-block dropdown mt-1"><a class="white dropdown-toggle ml-2" id="user-account"
                    href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                        class="user-name text-capitalize">{{ auth()->user()->full_name }}</span></a>
                <div class="text-light text-uppercase">{{ auth()->user()->permission_access }}</div>
                <div class="dropdown-menu arrow">
                    {{-- <a class="dropdown-item">
                        <i class="material-icons align-middle mr-1">person</i>
                        <span class="align-middle">Profile</span>
                    </a> --}}

                    <a class="dropdown-item" href="{{ route('admin.password.index') }}">
                        <i class="material-icons align-middle mr-1">settings</i>
                        <span class="align-middle">Mot de Passe</span>
                    </a>


                    <form class="dropdown-item" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">
                            <i class="material-icons">power_settings_new</i>
                            Se déconnecter
                        </button>
                    </form>

                    {{-- <a class="dropdown-item">
                        
                        <i class="material-icons align-middle mr-1">power_settings_new</i>
                        <span class="align-middle">Se déconnecter</span>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu-content text-capitalize d-none" style="overflow-y: auto;">
        <ul class="navigation navigation-main mb-5" id="main-menu-navigation" data-menu="menu-navigation">
            @can('view dashboard')
                <li class=" nav-item">
                    <a href="/admin">
                        <i class="material-icons">settings_input_svideo</i>
                        <span class="menu-title" data-i18n="">Dashboard</span>
                    </a>
                </li>
            @endcan

            <li class=" navigation-header">
                <span data-i18n="nav.category.ecommerce">Mon Magasin</span>
                <i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right"
                    data-original-title="Ecommerce">more_horiz</i>
            </li>


            @can('view all')
                <li class="nav-item">
                    <a href="{{ route('admin.utilisateurs.index') }}">
                        <span class="material-icons">people</span>
                        <span class="menu-title">Ulitisateurs</span>
                    </a>
                </li>
            @endcan

            @can('view_customer')
                <li class="nav-item">
                    <a href="{{ route('admin.clients.index') }}">
                        <span class="material-icons">groups</span>
                        <span class="menu-title">Clients</span>
                    </a>
                </li>
            @endcan

            @can('view all')
                <li class="nav-item">
                    <a href="{{ route('admin.fournisseurs.index') }}">
                        <span class="material-icons">real_estate_agent</span>
                        <span class="menu-title">Fournisseurs</span>
                    </a>
                </li>
            @endcan

            @can('view article')
                <li class=" nav-item">
                    <a href="#">
                        <i class="material-icons">content_paste</i>
                        <span class="menu-title">Structure</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item">
                            <a href="{{ route('admin.category-articles.index') }}">
                                <span class="menu-title">Famille D'Articles</span>
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admin.approvisionnement.articles.index') }}">
                                <i class="material-icons"></i>
                                <span>Article</span>
                            </a>
                        </li>
                        {{-- <li>
                        <a class="menu-item" href="{{ route('admin.approvisionnement.packages.index') }}">
                            <i class="material-icons"></i>
                            <span>Article En Gros</span>
                        </a>
                    </li> --}}
                        @can('view all')
                            <li>
                                <a class="menu-item" href="{{ route('admin.tarif-fournisseurs.index') }}">
                                    <i class="material-icons"></i>
                                    <span>Tarif Fournisseurs</span>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a class="menu-item" href="{{ route('admin.approvisionnement.emballages.index') }}">
                                <i class="material-icons"></i>
                                <span>Emballage </span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('view_intern_doc')
                <li class=" nav-item">
                    <a href="#">
                        <i class="material-icons">content_paste</i>
                        <span class="menu-title">Documents interne </span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item">
                            <a href="{{ route('admin.achat-fournisseurs.index') }}">
                                <span class="menu-title">bon d'entrée</span>
                            </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admin.sorti-stocks.index') }}">
                                <i class="material-icons"></i>
                                <span>Bon de sortie</span>
                            </a>
                        </li>
                        {{-- <li>
                        <a class="menu-item" href="{{route('admin.retour-fournisseurs.index')}}">
                            <i class="material-icons"></i>
                            <span>Retour Fournisseurs</span>
                        </a>
                    </li> --}}
                    </ul>
                </li>
            @endcan

            @can('view sale')
                <li class="nav-item">
                    <a href="{{ route('admin.ventes.index') }}">
                        <span class="material-icons">
                            shopping_basket
                        </span>
                        <span class="menu-title">Ventes</span>
                    </a>
                </li>
            @endcan

            @can('view stock')
                <li class="nav-item">
                    <a href="{{ route('admin.stocks.index') }}">
                        <span class="material-icons">liquor</span>
                        <span class="menu-title">Stocks</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.etat-emballages.index') }}">
                        <span class="material-icons">liquor</span>
                        <span class="menu-title">Etat d'Emballage</span>
                    </a>
                </li>
            @endcan

            @can('view inventory')
                <li class="nav-item">
                    <a href="{{ route('admin.inventaires.index') }}">
                        <span class="material-icons">table_rows</span>
                        <span class="menu-title">Inventaire</span>
                    </a>
                </li>
            @endcan
            {{-- @can('commercialState', \App\Models\DocumentVente::class)
                <li class="nav-item">
                    <a href="{{ route('admin.commercialState.index') }}">
                        <span class="material-icons">account_balance_wallet</span>
                        <span class="menu-title">Etat Commerciale</span>
                    </a>
                </li>
            @endcan --}}
        </ul>
    </div>
</div>
