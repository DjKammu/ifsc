<template>
  <div>
  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="header_content">
            <nav class="navbar navbar-expand-md navbar-dark">
              <!-- Brand -->
              <router-link class="navbar-brand"  to="/">GET BANK IFSC </router-link>
              
              <!-- Toggler/collapsibe Button -->
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              
              <!-- Navbar links -->
              <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item" v-for="routes in links" >
                     <router-link class="nav-link"
                      v-bind:key="routes.id"
                      :to="`${routes.page}`">{{routes.text}}
                    </router-link>
                 </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
    
  </div>
</template>

<script>
   
export default {
  name: 'Navigation',
  data() {
    return {
      links: [
        {
          id: 0,
          text: 'Home',
          page:'/'
        },
        {
          id: 2,
          text: 'Search By Bank Name',
          page:'/'
        },
        {
          id: 3,
          text: 'Search By Branch Name',
          page:'/'
        },
        {
          id: 4,
          text: 'Search By IFSC Code',
          page:'/ifsc'
        }
      ]
    }
  }
}
</script>