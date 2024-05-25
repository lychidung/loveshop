<script >
import { BaseTransitionPropsValidators } from 'vue';
import { ref } from 'vue'
import { defineComponent } from "vue";
export default defineComponent({
   
    props: {
        cates: Array,
       id: Number,
    },
    setup(props){
      const selected=ref(props.id);
      return {selected};
    }
   
});
//const selected = ref('choise')
//const selected = props.id
//const selected = ref('')
</script>

<template>
  
 <!-- <div>Selected: {{ selected }}</div>-->
 
  <select 
  class="border-blue-900 bg-white text-blue-900 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm"
  
  v-model="selected"
  >
   
    <option v-for="cate in cates" :value="cate.id" >{{ cate.name }}</option>
  </select>
</template>