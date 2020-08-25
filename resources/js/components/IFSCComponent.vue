<template>
 <div >

   <div class="intro">
    <div class="container">
      <div class="row intro_row">       
        <div class="col-lg-3">  </div>        
        <div class="col-lg-6 intro_col">
          <div>
            <h2 class="mb-5 text-center">Search Bank details from IFSC Code</h2> 
              <div class="search_box_container">
                <div class="search_form_container">
                  <div id="search_form" class="search_form">
                     <h3>Search Bank details from IFSC Code</h3>
                    <input @blur="selectIFSC()" @keydown.enter="selectIFSC()" v-model="selectedIFSC" /> 
                      <span style="float: right;color: #fff;"> 
                      Click below after IFSC Code entered</span>
                  </div>
                </div>
              </div>
          </div>          
        </div>
        <div class="col-lg-3">  </div>
      </div>
      <div>
        <div class="row mt-5">
          <div class="col-lg-2">  </div>    
          <div class="col-lg-8 bank-lists" v-if="ifscDetail['ifsc_code']">
            <h2 class="mb-5 text-center">Bank Details of {{ ifscDetail['ifsc_code'] }}</h2> 

            <table class="table table-hover">
                 
                  <tbody>
                    <tr>
                      <th scope="row">Bank</th>
                      <td scope="col" v-if="ifscDetail['bank']">{{ this.ifscDetail['bank']['name'] }}</td>
                    </tr> 
                    <tr>
                      <th scope="row">State</th>
                      <td scope="col" v-if="ifscDetail['state']">{{ this.ifscDetail['state'] }}</td>
                    </tr> 
                    <tr>
                      <th scope="row">District</th>
                      <td scope="col" v-if="ifscDetail['district']">{{ this.ifscDetail['district'] }}</td>
                    </tr>
                    <tr>
                      <th scope="row">City</th>
                      <td scope="col" v-if="ifscDetail['city']">{{ this.ifscDetail['city'] }}</td>
                    </tr> 
                    <tr>
                      <th scope="row">Branch</th>
                      <td scope="col" v-if="ifscDetail['branch']">{{ this.ifscDetail['branch'] }}</td>
                    </tr>
                    <tr>
                      <th scope="row">IFSC Code</th>
                      <th scope="col" v-if="ifscDetail['ifsc_code']">{{ this.ifscDetail['ifsc_code'] }}</th>
                    </tr>
                    <tr>
                      <th scope="row">Address</th>
                      <td scope="col" v-if="ifscDetail['address']">{{ this.ifscDetail['address'] }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Phone Number</th>
                      <td scope="col" v-if="ifscDetail['phone']">{{ this.ifscDetail['phone'] }}</td>
                    </tr>
                    <tr>
                      <th scope="row">STD Code</th>
                      <td scope="col" v-if="ifscDetail['std_code']">{{ this.ifscDetail['std_code'] }}</td>
                    </tr>
                    <tr>
                      <th scope="row">MICR Code</th>
                      <th scope="col" v-if="ifscDetail['micr_code']">{{ this.ifscDetail['micr_code'] }}</th>
                    </tr>
                   
                  </tbody>
                </table>

          </div>

          <div class="col-lg-2">  </div>    
          

        </div>

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
        name: 'ifsc',
        data: function() {
          return {
            errors: '',
            selectedIFSC: this.$route.params.ifsc,
            bankOptions : [],
            ifscDetail : []
          }
        },
        watch: { 
             '$route' (to, from){
               this.fetchIFSC()
            }
        },
        mounted () {
            this.fetchBanks() 
            if(this.selectedIFSC != ''){
              this.fetchIFSC()
            }
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
        },fetchIFSC(){
            this.$http.get(BaseUrl+`/api/ifsc/?ifsc=`+this.selectedIFSC)
            .then(response => {
                if(response.data){
                this.ifscDetail = response.data
                }
            })
            .catch(e => {
              this.errors.push(e)
            })
        },
        selectIFSC(){
          let ifsc = this.selectedIFSC
          this.$router.push({name: 'ifsc', params: { ifsc: ifsc }}).catch(()=>{});
        }

        }
    }
</script>