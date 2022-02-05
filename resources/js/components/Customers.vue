<template>
  <div>    
    <form @submit.prevent="addCustomer" class="mb-3">
   
      <div class="row">
          <div class="col-md-4"> 
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" v-model="customer.name">
              </div>
          </div>
          <div class="col-md-4"> 
              <div class="form-group">
                <select class="form-control" v-model="customer.country_id">
                          <option value="0"> Select Country </option>
                          <option v-for="country in countries" :value="country.id"> {{ country.name }} </option>
                </select> 
              </div>
          </div>
          <div class="col-md-4"> 
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Phone" v-model="customer.phone">
              </div>
          </div>
    </div>
      <button type="submit" class="btn btn-success btn-block">Add Customer</button>
    </form>

    <div class="row">
          <div class="col-md-4"> 
              <select class="form-control" v-model="country_filter" @change="fetchCustomers()">
                  <option value="0"> Select Country </option>
                  <option v-for="country in countries" :value="country.id"> {{ country.name }} </option>
              </select> 
          </div>
          <div class="col-md-4"> 
              <select class="form-control" v-model="status_filter" @change="fetchCustomers()">
                  <option value="3">   Select Status </option>
                  <option value="0">  NOk </option>
                  <option value="1"> Ok </option>
              </select> 
          </div>
          <div class="col-md-4"> 
              <nav aria-label="Page navigation example">
                  <ul class="pagination">
                      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                      <a class="page-link" href="#" @click="fetchCustomers(pagination.prev_page_url)">Previous</a></li>

                    <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li> 
                  
                      <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                      <a class="page-link" href="#" @click="fetchCustomers(pagination.next_page_url)">Next</a></li>
                    </ul> 
              </nav> 
          </div>
    </div>
    <br>

    <table class="table table-striped">
        <tr>
          <th>Name</th>
          <th>Phone</th>
          <th>Status</th>
          <th>Country</th>
          <th>Code</th>
        </tr>
        <tr v-for="data in customers" v-bind:key="data.id">
          <td> {{ data.name }}  </td>
          <td> {{ data.phone }} </td>
          <td> {{ data.status }} </td>
          <td> {{ data.countryData.name }} </td>
          <td> {{ data.countryData.code }} </td>
        </tr>
    </table>

  </div>
</template>

<script>
export default 
{
  data() {
    return {
      country_filter: 0,
      status_filter: 3,
      countries: [],
      customers: [],
      pagination: {},
      customer: {
        id: '',
        name: '',
        phone: '',
        country_id: 0,
      },
    };
  },
  created() {
    this.fetchCustomers();
    this.fetchCountries();
  },
  methods: {
          fetchCountries() {
                fetch('/api/countries')
                .then(res => res.json())
                .then(res => {
                  this.countries = res.data;
                })
                .catch(err => console.log(err));
            }, // end fetchCountries

          fetchCustomers(page_url) {
                let vm = this;
                page_url = page_url || '/api/customers';
                axios.get(page_url,{
                    params: {
                        country_filter: this.country_filter,
                        status_filter: this.status_filter
                    }
                })
                .then(function(response){
                    this.customers = response.data.data;
                    vm.makePagination(response.data.meta, response.data.links);
                }.bind(this));
            }, // end fetchCustomers
                // Add
            addCustomer() {
                  fetch('api/customer', {
                    method: 'post',
                    body: JSON.stringify(this.customer),
                    headers: {
                      'content-type': 'application/json'
                    }
                  })
                    .then(res => res.json())
                    .then(data => {
                      alert('Customer Added');
                      this.fetchCustomers();
                    })
                    .catch(err => console.log(err));
            },
            makePagination(meta, links) {
              let paginationn = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
              };
              this.pagination = paginationn;
            }
      
  }
};
</script>