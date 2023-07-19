<script>
import axios from 'axios'
export default {
  data() {
    return {
      require: true,
      sku: '',
      name: '',
      price: '',
      select: 'none',
      isDuplicate: false,
      errorCount: 0,
      notNumeric: 0,
      skuData: [],
      fields: {
        none: {
          show: 'none',
          req: true
        },
        dvd: {
          show: 'none',
          req: false,
          check: false,
          input: '',
          input_second: 0,
          input_third: 0
        },
        furniture: {
          show: 'none',
          req: false,
          check: false,
          input: '',
          input_second: '',
          input_third: ''
        },
        book: {
          show: 'none',
          req: false,
          check: false,
          input: '',
          input_second: 0,
          input_third: 0
        }
      },
    };
  },
  methods: {
    dropdown: function () {
      for(let field in this.$data.fields) {
        this.$data.fields[field].show = 'none';
      }
      this.$data.fields[this.select].show = 'block';
    },
    submitForm: function (e) {
      axios.post('/posts/insert', document.forms.product_form).then((res) => {
        console.log(res);
        window.location = '/'
      }).catch((err) => {
        alert(err.response.data.message);
      });
    }
  }
};
</script>

<!--Template -->

<template>
  <header>
    <h1>Product Add</h1>
    <ul class="add-delete-button">
      <li class="add-product-button-wrapper"><button name="save_add" value="submit" type="submit" id="add-product-btn" form="product_form" @click="submitForm">Save</button></li>
      <li class="delete-product-button-wrapper"><button id="delete-product-btn" name="mass-delete" onclick="location.href = '/'">Cancel</button></li>
    </ul>
  </header>
  <form name="product_form" id="form" action="/posts/insert" method="post">
    <div><p>SKU</p><input id="sku" type="text" name="sku" v-model="sku" v-on:input="errorCounter"></div>
    <div><p>Name</p><input id="name" type="text" name="name" v-model="name"></div>
    <div><p>Price ($)</p><input id="product_price" type="text" name="price" v-model="price"></div>
    <section>
      <label for="type-switcher" id="type-switcher">Type Switcher</label>
      <select name="switcher" id="productType" v-model="select" v-on:change="dropdown(select)">
        <option value="none" name="one" id="one"></option>
        <option value="dvd" name="dvd">DVD</option>
        <option value="furniture">Furniture</option>
        <option value="book" name="book">Book</option>
      </select>
    </section>
    <section>
      <div id="dvd" class="options" v-bind:style="{display: this.fields.dvd.show}">
        <div id="dvd_input_field">
          <p>Size (MB)</p>
          <input id="dvd_input" type="text" name="sizemb" v-model="fields.dvd.input" v-on:input="checkForNum">
        </div>
        <h3>Please provide disc space in MB.</h3>
      </div>
      <div id="furniture" class="options" v-bind:style="{display: this.fields.furniture.show}">
        <div id="furniture_input_field_0"><p>Height (CM)</p><input type="text" id="furniture_height" name="heightcm" v-model="fields.furniture.input" v-on:input="checkForNum"></div>
        <div id="furniture_input_field_1"><p>Width (CM)</p><input type="text" id="furniture_width" name="widthcm" v-model="fields.furniture.input_second" v-on:input="checkForNum"></div>
        <div id="furniture_input_field_2"><p>Length (CM)</p><input type="text" id="furniture_length" name="lengthcm" v-model="fields.furniture.input_third" v-on:input="checkForNum"></div>
        <h3>Please provide the height, width and length of the furniture piece in centimeters.</h3>
      </div>
      <div id="book" class="options" v-bind:style="{display: this.fields.book.show}">
        <div id="book_input_field"><p>Weight (KG)</p><input type="text" id="book_weight" name="weightkg" v-model="fields.book.input" v-on:input="checkForNum"></div>
        <h3>Please provide the weight of the book in KG.</h3>
      </div>
    </section>
  </form>
</template>