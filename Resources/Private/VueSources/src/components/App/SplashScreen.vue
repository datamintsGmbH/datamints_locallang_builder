<template>
  <div>
    
     
      <!-- Header -->
    <div class="header bg-primary py-4 py-lg-5 pt-lg-6">
      <b-container>
        <div class="header-body text-center mb-7">
          <b-row class="justify-content-center">
            <b-col xl="7" lg="8" md="10" class="px-5">
              <div class="d-flex align-items-end">
                <span class="h1 mr-4"><translation-icon width="86px" height="86px"></translation-icon></span><span class="h1 text-white"> datamints_locallang_builder</span>
                
              </div>
            </b-col>
            <b-col cols="8">
              <p class="text-lead text-white">Modify language files!</p>
            </b-col>
          </b-row>
        </div>
      </b-container>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
             xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SplashScreen",
};
</script>