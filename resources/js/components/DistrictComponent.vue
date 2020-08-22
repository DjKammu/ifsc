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
                     <h3>Find IFSC Code of Bank</h3>
                  <select @change="selectBank($event)" v-model="selectedBank">
                    <option value="">Please Select Bank Name</option>
                    <option v-for="option in bankOptions" v-bind:value="option.slug">
                    {{ option.name }}
                  </option>
                  </select>
                  <select @change="selectState($event)" v-model="selectedState">
                    <option value="">Please State Name</option>
                    <option v-for="option in stateOptions" v-bind:value="option.slug">
                      {{ option.name }}
                    </option>
                  </select>
                  <select @change="selectDistrict($event)" v-model="selectedDistrict">
                    <option value="">Please District Name</option>
                    <option v-for="option in districtOptions" v-bind:value="option.slug">
                      {{ option.name }}
                    </option>
                  </select>
                  <select @change="selectCity($event)" v-model="selectedCity">
                    <option value="">Please City Name</option>
                     <option v-for="option in cityOptions" v-bind:value="option.slug">
                      {{ option.name }}
                    </option>
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
            <h2 class="mb-5 text-center">Cities for district {{ this.selectedDistrict }}   {{ this.selectedState }} state having bank {{ this.selectedBank }}</h2> 
            <ul class="banks-ul">
              <li class="text-md-left text-center mt-2 mb-2" v-for="option in cityOptions">
                <router-link 
                  :to="{ name: 'city', params: { bank : selectedBank , state: selectedState, district: selectedDistrict , city: option.slug }}"> {{ option.name }}
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
            selectedBank: this.$route.params.bank,
            selectedState: this.$route.params.state,
            selectedDistrict : this.$route.params.district,
            selectedCity : '',
            districtOptions : [],
            stateOptions : [],
            cityOptions : [],
            bankOptions : []
          }
        },
        watch: { 
             '$route' (to, from){
                this.fetchCities()
            }
        },
        mounted () {
            this.fetchBanks() 
            this.fetchStates() 
            this.fetchDistricts() 
            this.fetchCities() 
        },
        methods: {
        fetchBanks(){
            this.$http.get(`/api/banks`)
            .then(response => {
              this.bankOptions = response.data
            })
            .catch(e => {
              this.errors.push(e)
            })
        },fetchStates(){
            this.$http.get(BaseUrl+`/api/states/?bank=`+this.selectedBank)
            .then(response => {
              this.stateOptions = response.data
            })
            .catch(e => {
              this.errors.push(e)
            })
        },fetchDistricts(){
            this.$http.get(BaseUrl+`/api/districts/?bank=`+this.selectedBank+`&state=`+this.selectedState)
            .then(response => {
              this.districtOptions = response.data
            })
            .catch(e => {
              this.errors.push(e)
            })
        },fetchCities(){
            this.$http.get(BaseUrl+`/api/cities/?bank=`+this.selectedBank+`&state=`+this.selectedState+`&district=`+this.selectedDistrict)
            .then(response => {
              this.cityOptions = response.data
            })
            .catch(e => {
              this.errors.push(e)
            })
        },
        selectBank(event){
          let bank = event.target.value
          this.$router.push({name: 'bank', params: { bank: bank }})
        },
        selectState(event){
          let state = event.target.value
          this.$router.push({name: 'state', params: { bank : this.selecteBank , state: state }})
        },
        selectDistrict(event){
          let district = event.target.value
          this.$router.push({name: 'district', params: { bank : this.selectedBank , state: this.selectedState, district: district }})
        },
        selectCity(event){
          let city = event.target.value
          this.$router.push({name: 'city', params: { bank : this.selectedBank , state: this.selectedState, district: this.selectedDistrict , city: city }})
        }

        }
    }
</script>