<template>

  <ais-index app-id="YXBLBS70KG"
             api-key="59e169adb5bfbd6c8b765b38455bc36c"
             index-name="users"
             >
             <div class="form-group">
               <ais-input placeholder="Search users...." type="input" class="form-control"></ais-input>
             </div>

             <ais-results inline-template>
                 <table class="table">
                   <thead>
                     <tr>
                       <th scope="col">id</th>
                       <th scope="col">Name</th>
                       <th scope="col">Email</th>
                       <th scope="col">Created at</th>
                       <th scope="col">#</th>
                     </tr>
                   </thead>
                   <tbody>
                       <tr v-for="result in results" :key="result.id">
                         <th scope="row">{{ result.id }}</th>
                         <td><a :href="'/profiles/' + result.name">{{ result.name }}</a></td>
                         <td>{{ result.email }}</td>
                         <td>{{ result.created_at }}</td>
                       </tr>

                   </tbody>
                 </table>

             </ais-results>

           </ais-index>



</template>

<script>
  export default {
  props: ['attributes'],

  data () {
    return {
      data: this.attributes
    }
  },

  mounted () {
    console.log(this.data)
  }
  }
</script>
