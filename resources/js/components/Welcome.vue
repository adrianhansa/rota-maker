<template>
    <div class="container">
        <div class="row m-auto mt-3">
            <div class="col-12">
                <h1 class="text-center">Welcome to RotaMaker!</h1>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-7">
                <p>This platform was build for the residential home services .... to help them easily create rotas for their staff so it will better cover the service needs.</p>
            </div>
            <div class="col-5">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="register-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="login-tab">
                    <login></login>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="register-tab">
                    <register></register>
                  </div>
                </div>
            </div>
        </div>
    </div>
</template>
