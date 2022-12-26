<div  class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
     <div  class="container">
        <div class="row">
              <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div style="background-color:#414c8c;" class="card border-0 shadow rounded-3 my-5">

                        <div  class="card-body p-4 p-sm-5">
                            <h4 class="card-title text-center mb-4 fw-light fs-5 text-white"><b>ACESSO AO SISTEMA</b></h4>
                                <span class="d-flex justify-content-center">{{ $logo }}</span>

                                    <div  class="w-full sm:max-w-md px-6 py-0 shadow-md overflow-hidden sm:rounded-lg">
                                        {{ $slot }}
                                    </div>
                        </div>

                    </div>
               </div>
        </div>
     </div>
</div>
