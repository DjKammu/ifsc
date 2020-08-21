<template>
  <div>
        <div class="top-bar">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right"> 
                              <li class="nav-item" v-for="routes in links" >
                                 <router-link 
                                  v-bind:key="routes.id"
                                  :to="`${routes.page}`">{{routes.text}}
                                </router-link>
                             </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="logo">
          <router-link  to="/">Get Your <span>IFSC</span></router-link>
        </div>
    
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
          text: 'About',
          page:'/about'
        },
        {
          id: 3,
          text: 'Contact',
          page:'/contact'
        }
      ]
    }
  }
}
</script>