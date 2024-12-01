<!-- Features Section -->
<section id="features" class="features section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('Features') }}</h2>
        <p>{{ __('Discover the powerful modules that make QuickSell your ultimate solution for efficient business management.') }}</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="d-flex justify-content-center">

            <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">

                <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-clients">
                        <h4>{{ __('Clients') }}</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-suppliers">
                        <h4>{{ __('Suppliers') }}</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-products">
                        <h4>{{ __('Products & Categories') }}</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-sales">
                        <h4>{{ __('Sales & Transactions') }}</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-stock">
                        <h4>{{ __('Stock Manager') }}</h4>
                    </a>
                </li><!-- End tab nav item -->

            </ul>

        </div>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

            <!-- Clients Tab -->
            <div class="tab-pane fade active show" id="features-tab-clients">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                        <h3>{{ __('Client Management') }}</h3>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> {{ __('Create, edit, and delete clients effortlessly.') }}</li>
                            <li><i class="bi bi-check2-all"></i> {{ __('Export client lists to various formats.') }}</li>
                            <li><i class="bi bi-check2-all"></i> {{ __('Comprehensive client data tables for analysis.') }}</li>
                        </ul>
                        <p class="fst-italic">
                            {{ __('Manage your clients efficiently with advanced tools and insights.') }}
                        </p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="assets/img/features-clients.webp" alt="{{ __('Clients Module') }}" class="img-fluid">
                    </div>
                </div>
            </div><!-- End Clients Tab -->

            <!-- Suppliers Tab -->
            <div class="tab-pane fade" id="features-tab-suppliers">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                        <h3>{{ __('Supplier Management') }}</h3>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> {{ __('Add, update, and delete supplier records.') }}</li>
                            <li><i class="bi bi-check2-all"></i> {{ __('Export supplier data with ease.') }}</li>
                            <li><i class="bi bi-check2-all"></i> {{ __('Track supplier interactions and transactions.') }}</li>
                        </ul>
                        <p class="fst-italic">
                            {{ __('Keep a detailed record of your suppliers to streamline procurement and stock management.') }}
                        </p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="assets/img/features-suppliers.webp" alt="{{ __('Suppliers Module') }}" class="img-fluid">
                    </div>
                </div>
            </div><!-- End Suppliers Tab -->

            <!-- Products Tab -->
            <div class="tab-pane fade" id="features-tab-products">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                        <h3>{{ __('Products & Categories') }}</h3>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> {{ __('Add and organize products into categories.') }}</li>
                            <li><i class="bi bi-check2-all"></i> {{ __('Bulk import/export products with ease.') }}</li>
                            <li><i class="bi bi-check2-all"></i> {{ __('Track inventory levels and pricing.') }}</li>
                        </ul>
                        <p class="fst-italic">
                            {{ __('Simplify product management and maintain a well-organized inventory.') }}
                        </p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="assets/img/features-products.webp" alt="{{ __('Products Module') }}" class="img-fluid">
                    </div>
                </div>
            </div><!-- End Products Tab -->

            <!-- Sales Tab -->
            <div class="tab-pane fade" id="features-tab-sales">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                        <h3>{{ __('Sales & Transactions') }}</h3>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> {{ __('Record and track all sales transactions.') }}</li>
                            <li><i class="bi bi-check2-all"></i> {{ __('Detailed reporting on sales performance.') }}</li>
                            <li><i class="bi bi-check2-all"></i> {{ __('Monitor purchase transactions for better control.') }}</li>
                        </ul>
                        <p class="fst-italic">
                            {{ __('Gain full visibility of your sales and financial transactions.') }}
                        </p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="assets/img/features-sales.webp" alt="{{ __('Sales Module') }}" class="img-fluid">
                    </div>
                </div>
            </div><!-- End Sales Tab -->

            <!-- Stock Tab -->
            <div class="tab-pane fade" id="features-tab-stock">
                <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                        <h3>{{ __('Stock Manager') }}</h3>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> {{ __('Manage stock levels for all products.') }}</li>
                            <li><i class="bi bi-check2-all"></i> {{ __('Track stock adjustments and audits.') }}</li>
                            <li><i class="bi bi-check2-all"></i> {{ __('Generate stock reports for better insights.') }}</li>
                        </ul>
                        <p class="fst-italic">
                            {{ __('Stay on top of your inventory with powerful stock management tools.') }}
                        </p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="assets/img/features-stock.webp" alt="{{ __('Stock Module') }}" class="img-fluid">
                    </div>
                </div>
            </div><!-- End Stock Tab -->

        </div>

    </div>

</section><!-- /Features Section -->
