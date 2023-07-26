//Lấy thông tin giỏ hàng từ localStorage
const cartItems = getCartItems();

//Tạo nội dung giỏ hàng trên trang
const cartItemsContainer = document.getElementById('cart-items');

if (cartItems.length === 0) {
  const emptyRow = document.createElement('tr');
  const emptyCell = document.createElement('td');
  const cart2 = document.querySelector('.sp-cart2');
  emptyCell.setAttribute('colspan', '6');
  emptyCell.textContent = 'Không có sản phẩm nào trong giỏ hàng';
  emptyRow.appendChild(emptyCell);
  cartItemsContainer.appendChild(emptyRow);
  cart2.style.display = 'none';
} else {
  let totalPrice = 0;

  cartItems.forEach(item => {
    const row = document.createElement('tr');

    const imageCell = document.createElement('td');
    const image = document.createElement('img');
    image.src = item.image; //Đặt đường dẫn đến hình ảnh sản phẩm
    image.alt = 'Hình ảnh sản phẩm';
    image.classList = "img-cart";
    imageCell.appendChild(image);
    row.appendChild(imageCell);

    const nameCell = document.createElement('td');
    nameCell.textContent = item.name;
    row.appendChild(nameCell);

    const priceCell = document.createElement('td');
    priceCell.textContent = item.price;
    row.appendChild(priceCell);

    const quantityCell = document.createElement('td');
    const quantityInput = document.createElement('input');
    quantityInput.className = "input-cart";
    quantityInput.type = 'number';
    quantityInput.value = item.quantity;
    quantityInput.min = '1';  //Số lượng tối thiểu là 1
    quantityInput.addEventListener('input', (event) => {
      const newQuantity = parseInt(event.target.value);

      //Cập nhật số lượng
      updateQuantity(item.name, newQuantity);

      //Cập nhật giá tiền
      const priceCell = row.querySelector('.price');
      const totalPriceCell = row.querySelector('.total-price');
      const price = parseInt(item.price);
      const totalPrice = price * newQuantity;
      priceCell.textContent = totalPrice + ' VND';
      totalPriceCell.textContent = totalPrice + ' VND';

      //Cập nhật tổng số lượng và tổng giá tiền
      updateSummary();
      location.reload();
    });
    quantityCell.appendChild(quantityInput);
    row.appendChild(quantityCell);

    //Ô tiền
    const totalCell = document.createElement('td');
    const totalPriceForItem = parseInt(item.price) * item.quantity;
    totalCell.textContent = totalPriceForItem + ' VND';
    row.appendChild(totalCell);

    const actionCell = document.createElement('td');
    const deleteButton = document.createElement('button');
    deleteButton.classList = "remove-item";
    deleteButton.textContent = 'Xóa';
    deleteButton.addEventListener('click', () => {
      //Xử lý khi nhấp vào nút "Xóa"
      deleteCartItem(item.name);
      location.reload();  //Tải lại trang để cập nhật giỏ hàng
    });
    actionCell.appendChild(deleteButton);
    row.appendChild(actionCell);

    cartItemsContainer.appendChild(row);

    totalQuantity += item.quantity;
    totalPrice += totalPriceForItem;
  });

  //Cập nhật tổng số lượng và tổng tiền
  document.getElementById('total-price').textContent = totalPrice + ' VND';
}

//Hàm lấy thông tin giỏ hàng từ localStorage
function getCartItems() {
  const cartItems = localStorage.getItem('cartItems');
  return cartItems ? JSON.parse(cartItems) : [];
}

//Hàm lưu thông tin giỏ hàng vào localStorage
function saveCartItems(items) {
  localStorage.setItem('cartItems', JSON.stringify(items));
}

//Hàm xóa sản phẩm khỏi giỏ hàng
function deleteCartItem(productName) {
  const cartItems = getCartItems();
  const updatedCartItems = cartItems.filter(item => item.name !== productName);
  saveCartItems(updatedCartItems);
}

function updateQuantity(productName, newQuantity) {
  const cartItems = getCartItems();

  //Tìm sản phẩm trong giỏ hàng dựa trên tên
  const productIndex = cartItems.findIndex(item => item.name === productName);

  if (productIndex !== -1) {
    //Cập nhật số lượng sản phẩm
    cartItems[productIndex].quantity = newQuantity;

    //Lưu thông tin giỏ hàng mới vào localStorage
    saveCartItems(cartItems);
  }
}

function updateTotalPrice() {
  location.reload();
}