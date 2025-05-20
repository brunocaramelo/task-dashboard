<template>
    <div class="flex justify-end">
      <nav aria-label="Page navigation example">
          <ul class="flex list-style-none">
              <div class="flex mt-1 text-gray-500 font-semibold pt-0.5 mr-5">
                  <p class="mr-2 ">Total per page {{ data.per_page }} </p>
                  <p>{{ data.current_page }}</p> -
                  <p class="mr-2">{{ data.last_page }}</p> of
                  <p class="ml-2">{{ data.total }}</p>
              </div>
          <li class="page-item">
              <Link
                  class="capitalize page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-md text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                  v-if="data.prev_page_url"
                  preserve-state
                  method="get"
                  :href="data.prev_page_url">Prev
              </Link>
          </li>

          <li v-for="link in cleanLInks" :key="link.label"
              :class="{'bg-gray-100 text-gray-700 rounded-md' : link.active}"
              class="page-item mx-1">
              <Link
              preserve-state
              method="get"
              :href="link.url"
              class="page-link relative block py-1.5 px-3 border-1  outline-none transition-all duration-300 rounded-md hover:text-white hover:bg-sky-500 shadow focus:shadow-md"
              >{{ link.label }}
          </Link></li>


          <li class="page-item">
              <Link
                  preserve-state
                  class="capitalize page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                  v-if="data.next_page_url"
                  method="post"
                  :href="data.next_page_url">Next
              </Link>
          </li>
          </ul>
      </nav>
      </div>
  </template>

  <script>
    import { Link } from '@inertiajs/vue3'

    export default {
        components: { Link },
        props:{
            data: Object,
            params: String
        },
        computed:{
            cleanLInks(){
                const cleanLInks = [...this.data.links];
                cleanLInks.shift();
                cleanLInks.pop();
                return cleanLInks;
            }
        }
    }
  </script>
