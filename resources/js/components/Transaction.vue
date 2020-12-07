<template>
     <div class = "card">
        <div class="card-body">
            <div class = "row">
                <div class="col-11">
                    <h5 class="card-title">List of Client</h5>
                </div>
                <div class="col-1">
                    <a class="btn btn-success" 
                            href="" 
                            title="Create a project"> 
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="justify-content-center">
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <td>#</td>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="transaction in transactions"> 
                        <td></td>
                        <td>{{ transaction.client.fullname }} </td>
                        <td>{{ transaction.transaction_date }}</td>
                        <td>{{ transaction.amount }}</td>
                        <td>
                            <form action="" method="POST">
                                <a href="" title="show">
                                    <i class="fas fa-eye text-success  fa-lg"></i>
                                </a>
                                <a href="">
                                    <i class="fas fa-edit  fa-lg"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                    <i class="fas fa-trash fa-lg text-danger"></i>

                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            transactions: ''
            }
    },
    mounted() {
        axios.get('/api/transaction',  {
            headers: {
                'Authorization': `Bearer ${this.$store.state.token}`
            }
        }).then ( response => {
            this.transactions = response.data
        });
    }
}
</script>