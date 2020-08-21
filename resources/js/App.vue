<template>
  <div>
  <Navigation />
  <router-view />
</div>
</template>

<script type="text/javascript">
  import Navigation  from './components/Navigation.vue'
  export default{
    components:{
      Navigation // register component
    },
    watch: { 
         '$route' (to, from){
            this.fetchMeta()
        }
    },
     mounted () {
        this.fetchMeta()
	},
	 methods: {
	    fetchMeta(){
	    	let path = this.$route.fullPath
	        this.$http.get(BaseUrl+`/api/metas?path=`+path)
	        .then(response => {
	           var vm = response.data
	           document.title = vm.title;
	           document.head.querySelector('meta[name=description]').content =  vm.description
	           document.head.querySelector('meta[name=keywords]').content =  vm.keywords
	        })
	   }
	} 

  }

</script>