@extends('default')
@section("main_section")
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2>Product Add</h2>
                    </div>
                    <div class="card-body">
                        @isset($add)
                        <form action="{{route("product.store")}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Product Name</label><small class="req">*</small>
                                <input type="text" name="product_name" value="{{old("product_name")}}" class="form-control" id="exampleFormControlInput1" placeholder="Product Name">
                                
                                @error('product_name')
                                
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Category</label><small class="req">*</small>
                                <select required name="category_id" class="form-control" id="exampleFormControlSelect1">
                                    <option value="">Select Category</option>
                                @if($categories)
                                        @foreach ($categories as $item)
                                            <option @if(old("category_id")==$item->id) selected @endif value="{{$item->id}}">{{$item->category_name}}</option>
                                        @endforeach
                                @endif
                                </select>
                                @error('category_id')
                                
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput12">Selling Price</label><small class="req">*</small>
                                <input type="text" name="selling_price" value="{{old("selling_price")}}" class="form-control" id="exampleFormControlInput12" placeholder="Price">
                                @error('selling_price')
                                
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                        @endisset
                        @isset($edit)
                        <form action="{{route("product.update", $single->id)}}" method="POST">
                            @method("PUT")
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Product Name</label><small class="req">*</small>
                                <input type="text" name="product_name" value="{{$single->product_name}}" class="form-control" id="exampleFormControlInput1" placeholder="Product Name">
                                
                                @error('product_name')

                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Category</label><small class="req">*</small>
                                <select required name="category_id" class="form-control" id="exampleFormControlSelect1">
                                    <option value="">Select Category</option>
                                @if($categories)
                                        @foreach ($categories as $item)
                                            <option @if($single->category_id==$item->id) selected @endif value="{{$item->id}}">{{$item->category_name}}</option>
                                        @endforeach
                                @endif
                                </select>
                                @error('category_id')
                                
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput12">Selling Price</label><small class="req">*</small>
                                <input type="text" name="selling_price" value="{{$single->selling_price}}" class="form-control" id="exampleFormControlInput12" placeholder="Price">
                                @error('selling_price')
                                
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-info">Update</button>
                        </form>
                        @endisset
                    </div>
                </div>
            
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        
                <h2>All Products </h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Category Name</th>
                                <th>Selling Price</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody id="productTableBody">
                                {{-- @if ($products)
                                    @foreach ($products as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->category_name}}</td>
                                        <td>{{$item->selling_price}}</td>
                                        <td>
                                            <button type="button" class="btn btn-default">Edit</button>
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </td>
                                      </tr>
                                    @endforeach
                                @endif --}}
                             
                            </tbody>
                          </table>
                    </div>
                  </div>
               
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    $(document).ready( function() {
         getProducts();
        function generateTableRows(products) {
            let rows = '';
            for (let product of products) {
                rows += `<tr>
                            <td>${product.id}</td>
                            <td>${product.product_name}</td>
                            <td>${product.category_name}</td>
                            <td>${product.selling_price}</td>
                            <td>  
                                <div class="btn-group">
                                    <a href="/product/edit/${product.id}" class="btn btn-info">Edit</a>
                                    <button type="button" data-id="${product.id}" class="btn btn-danger delete-btn">Delete</button>
                                </div>
                            </td>
                         </tr>`;
            }
            return rows;
        }
        function getProducts() {
            console.log("call")
            $.ajax({
                url: `/product/products`,
                type: 'GET',
                dataType:"json",
                async:true,
                success: function(response) {
                    const tableBody = document.getElementById('productTableBody');
                    tableBody.innerHTML = generateTableRows(response.data);
                },
                error: function(response) {
                    console.log('An error occurred while deleting the master product.');
                }
            });
        }
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            let productId = $(this).data('id');
            if (!confirm('Are you sure you want to delete this product?')) {
                return; 
            }
            let $row = $(this).closest('tr');
            
            $.ajax({
                url: `/product/delete/${productId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    $.toast({
                        heading: 'Deleted!',
                        text: 'Your product delete successfully.',
                        position: 'top-right',
                        icon: 'success',
                        stack: false
                    })
                    $row.remove();
                },
                error: function(response) {
                    alert('An error occurred while deleting the master product.');
                }
            });
        });
    });
</script>
@endpush