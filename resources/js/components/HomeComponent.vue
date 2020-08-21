<template>
 <div >
  <section class="about" id="about">
          <div class="container">
            <div class="banner-inner">
              <div class="col-md-8 col-md-offset-2 banner-left">
                <h3>Find IFSC Code of Bank</h3>
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

              </div>
            </div>
            <div class="clearfix"></div>

          </div>
          <div class="container">
            <div class="about-heading">
              <h2>All Banks</h2>
            </div>

            <ul class="banks-ul">
              <li v-for="option in bankOptions">
                    <router-link 
                  :to="{ name: 'bank', params: { bank: option.slug }}"> {{ option.name }}
                </router-link>
              </li>
            </ul>

            <div class="clearfix"></div>

          </div>
      </section> 
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