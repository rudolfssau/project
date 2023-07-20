<script>
import axios from 'axios'
export default {
  data() {
    return {
      dvd: '',
      furniture: '',
      book: '',
      users: [],
      itemsToDelete: [],
    }
  },
  methods: {
    getAllUsers: function () {
      axios.get('/get/returnJson')
          .then((response) => {
            this.users = response.data;
          });
    },
    deleteUser: function () {
      if (this.itemsToDelete.length) {
        axios.post('/home/delete', {
          id: JSON.parse(JSON.stringify(this.itemsToDelete))
        }).then((response) => {
          console.log(response.data);
          window.location.href = "/";
        });
      }
    }
  },
  mounted() {
    this.getAllUsers()
  }
}
</script>

<!--Template-->

<template>
  <header>
    <h1>Product List</h1>
    <ul class="add-delete-button">
      <li class="add-product-button-wrapper"><button id="add-product-btn" name="add" onclick="location.href = '/addproducts';">ADD</button></li>
      <li class="delete-product-button-wrapper"><button id="delete-product-btn" name="mass-delete" @click="deleteUser">MASS DELETE</button></li>
    </ul>
  </header>
  <section class="content">
    <div id="grid_container">
      <div id="table-row" v-for="user in users" :key="user.id">
        <div id="table-check"><input id="delete" class="delete-checkbox" :value="user.id" :name="user.id" v-model="itemsToDelete" type="checkbox"></div>
        <div v-if="user.switcher === 'dvd'" id="table-data">{{ user.sku }}</div>
        <div v-if="user.switcher === 'dvd'" id="table-data">{{ user.name }}</div>
        <div v-if="user.switcher === 'dvd'" id="table-data">{{ user.price }} $</div>
        <div v-if="user.switcher === 'dvd'" id="table-data">Size: {{ user.sizemb }} MB</div>
        <div v-if="user.switcher === 'furniture'" id="table-data">{{ user.sku }}</div>
        <div v-if="user.switcher === 'furniture'" id="table-data">{{ user.name }}</div>
        <div v-if="user.switcher === 'furniture'" id="table-data">{{ user.price }} $</div>
        <div v-if="user.switcher === 'furniture'" id="table-data">Dimensions: {{ user.heightcm }}x{{ user.widthcm }}x{{ user.lengthcm }}</div>
        <div v-if="user.switcher === 'book'" id="table-data">{{ user.sku }}</div>
        <div v-if="user.switcher === 'book'" id="table-data">{{ user.name }}</div>
        <div v-if="user.switcher === 'book'" id="table-data">{{ user.price }} $</div>
        <div v-if="user.switcher === 'book'" id="table-data">Weight: {{ user.weightkg }} KG</div>
      </div>
    </div>
  </section>
</template>