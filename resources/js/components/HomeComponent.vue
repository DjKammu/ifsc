<template>
 <div >
 <div class="intro">
    <div class="container">
      <div class="row intro_row">       
        <div class="col-lg-3">  </div>        
        <div class="col-lg-6 intro_col">
          <div>
            <h2 class="mb-5 text-center">Find IFSC Code of Bank</h2> 
              <div class="search_box_container">
                <div class="search_form_container">
                  <form action="#" id="search_form" class="search_form">
                    <select @change="selectBank($event)" v-model="selected">
                    <option value="">Please Select Bank Name</option>
                    <option v-for="option in bankOptions" v-bind:value="option.slug">
                    {{ option.name }}
                  </option>
                  </select>
                  <select >
                    <option value="">State</option>
                  </select>
                  <select >
                    <option value="">District</option>
                  </select>
                  <select >
                    <option value="">City</option>
                  </select>
                  <select >
                    <option value="">Branch</option>
                  </select>
                  </form>
                </div>
              </div>
          </div>          
        </div>
        <div class="col-lg-3">  </div>
      </div>
      <div>
        <div class="row mt-5">
          <div class="col-lg-2">  </div>        
          <div class="col-lg-8 bank-lists">
            <h2 class="mb-5 text-center">All Banks</h2> 
            <ul class="banks-ul">
              <li class="text-md-left text-center mt-2 mb-2" 
              v-for="option in bankOptions">
                    <router-link 
                  :to="{ name: 'bank', params: { bank: option.slug }}"> {{ option.name }}
                </router-link>
              </li>                  
            </ul>

          </div>
          <div class="col-lg-2">  </div>    
          
        </div>
        
      </div>
    </div>
  </div>
    </div>
</template>

<script>

    export default {
        name: 'home',
        data: function() {
          return {
            errors: '',
            selected: '',
            bankOptions : []
          }
        },
        mounted () {
            this.fetchBanks()
        },
        methods: {
        fetchBanks(){
            this.$http.get(BaseUrl+`/api/banks`)
            .then(response => {
              this.bankOptions = response.data
            })
            .catch(e => {
              this.errors.push(e)
            })
        },
        selectBank(event){
          let bank = event.target.value
          this.$router.push({name: 'bank', params: { bank: bank }})
        }

        }
    }
</script>