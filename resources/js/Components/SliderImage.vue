<template class="flex items-center self-cente h-1">
    <Carousel :autoplay="10000" :wrap-around="true">
      <Slide v-for="slide in 1" :key="slide">
            <img class ="object-cover  " src="/Images/poster1.jpg" alt="">

      </Slide>

      <Slide v-for="slide in 1" :key="slide">
            <img class ="object-fill  " src="/Images/poster1.jpg" alt="">

      </Slide>

      <Slide v-for="slide in 1" :key="slide">
            <img class ="object-fill" src="/Images/poster1.jpg" alt="">

      </Slide>

      
  
      <template #addons>
        <Navigation />
      </template>
    </Carousel>
  </template>
  
  <script>
  import { defineComponent } from 'vue'
  import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
  
  import 'vue3-carousel/dist/carousel.css'
  
  export default defineComponent({
    name: 'Basic',
    components: {
      Carousel,
      Slide,
      Pagination,
      Navigation,
    },
   
  })
  </script>
  
  <style>
  .carousel__viewport{
    min-height: 440px;
  }

  .carousel__item {
    min-height: 200px;
    width: 100%;
    background-color: white;
    color: var(--vc-clr-white);
    font-size: 20px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .carousel__slide {
    padding: 10px;
    min-height: 440px;
  }
  
  .carousel__prev,
  .carousel__next {
    box-sizing: content-box;
    background-color: #ff8fab;
    border-radius: 50%;
    padding: 5px;
  }

  .carousel__icon{
    color: white;
  }

  </style>