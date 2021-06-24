<!-- Modal -->
<div class="modal fade" id="addIngredients" tabindex="-1" role="dialog" aria-labelledby="addIngredientsTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="heading-food">
          <h3>{{ $picked->name }}</h3>
          <span></span>
          <p>{{ $picked->remark }}</p>
        </div>
        <div class="row align-items-center">
          <div class="col-3">
            <div class="foodprice">
              <h5>Price</h5>
              <h4>$ <span id="show_old_cart_price">{{ $varient->final_price }}</span></h4>
              
            </div>
          </div>
          <div class="col-9">
            <div class="qty-items">
              <div class="row">
                <div class="col-sm-6 col-6">
                  <select class="form-select" id="varient_type" onchange="manageVarientType()">
                    @foreach($all_varients as $all_varient)
                      <option value="{{ $all_varient->id }}" price="{{ $all_varient->final_price }}" @if($varient->id == $all_varient->id) selected @endif>{{ $all_varient->getQuantity ? $all_varient->getQuantity->type : '' }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-6 col-6">
                  <div class="input-group custom-groupplus">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" onclick="quantityDecrease()" data-type="minus" data-field="quant[1]">
                        <i class="fas fa-minus"></i>
                      </button>
                    </span>
                    <input type="text" name="quantity" id="food_quantity" class="form-control input-number" value="1" min="1" max="10">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" onclick="quantityIncrement()" data-type="plus" data-field="quant[1]">
                        <i class="fas fa-plus"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="cooking-level">
          <h4>COOKING LEVEL (MEAT) (required)</h4>
          <div class="custom-control custom-radio form-check-inline">
            <input type="radio" id="meat-1" name="payment" class="custom-control-input"/>
            <label class="custom-control-label" for="meat-1">White Rice</label>
          </div>
          <div class="custom-control custom-radio form-check-inline">
            <input type="radio" id="meat-2" name="payment" class="custom-control-input"/>
            <label class="custom-control-label" for="meat-2">Dill Rice</label>
          </div>
          <div class="custom-control custom-radio form-check-inline">
            <input type="radio" id="meat-3" name="payment" class="custom-control-input"/>
            <label class="custom-control-label" for="meat-3">Half/Half Rice</label>
          </div>
        </div>
        <div class="cooking-level">
          <h4>EXTRA INGREDIENTS</h4>
          <div class="row">
            <div class="col-md-6">
              @foreach($ingredients as $i => $ingredient)
              <div class="form-group">
                @php
                  $ingredient_price = $ingredient->getHighestPriceVarient($ingredient->id) ? $ingredient->getHighestPriceVarient($ingredient->id)->final_price : 0;
                @endphp
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="addon_varients" value="{{ $ingredient->id }}" class="custom-control-input" id="ingredient{{ $i }}" onclick="addIngredientsAmount('{{ $i }}', '{{ $ingredient_price }}')" />
                  <label class="custom-control-label" for="ingredient{{ $i }}">{{ $ingredient->name }} ${{ $ingredient_price }}</label>
                </div>
              </div>
              @endforeach
            </div>
            
          </div>
        </div>
        <div class="cooking-level">
          <h4>SPECIAL REQUESTS</h4>
          <textarea class="form-control" id="food_request" rows="3"></textarea>
        </div>
        <div class="total-price">
          <h4>Total Price</h4>
          <h3>$ <span id="show_order_total_price">{{ $varient->final_price }}</span></h3>
        </div>
      </div>
        <!-- Hidden Values Section -->
        <input type="hidden" name="food_id" id="food_id" value="{{ $picked->id }}">
        <input type="hidden" name="old_price" id="old_price" value="{{ $varient->final_price }}">
        <input type="hidden" name="final_price" id="cart_final_price" value="{{ $varient->final_price }}">
        <input type="hidden" name="ingredient_total" id="ingredient_total" value="0">
        <!-- Hidden Values Section -->
      <div class="modal-footer">
        <a href="javascript:void(0)" onclick="foodAddOncart()" class="btn btn-primary">Add to cart</a>
      </div>
    </div>
  </div>
</div>