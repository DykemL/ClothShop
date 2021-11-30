let updateProductButtons = document.getElementsByClassName('update-product');

for (let button of updateProductButtons) {
    button.onclick = async () => {
        let productId = button.dataset.productid;
        document.cookie = `productId=${productId}`;
        document.getElementById('modalTitle').innerText = "Изменение товара";
        document.getElementById('modalForm').setAttribute('action', '/admin/updateProduct');
        let product = await getProduct(productId);
        document.getElementById('productId').value = productId;
        document.getElementById('productName').value = product['name'];
        document.getElementById('productTypeSelect').value = product['type'];
        document.getElementById('productPrice').value = product['price'];
        document.getElementById('productProperties').value = product['properties'];
        document.getElementById('productDescription').value = product['description'];
        document.getElementById('modalButton').innerText = 'Изменить';
    }
}

let addProductButton = document.getElementById('addProduct');
addProductButton.onclick = () => {
    document.cookie = '';
    document.getElementById('modalTitle').innerText = "Добавление товара";
    document.getElementById('modalForm').setAttribute('action', '/admin/addProduct');
    document.getElementById('productName').value = '';
    document.getElementById('productTypeSelect').value = 0;
    document.getElementById('productPrice').value = '';
    document.getElementById('productProperties').value = '';
    document.getElementById('productDescription').value = '';
    document.getElementById('modalButton').innerText = 'Добавить';
}

let deleteProductButton = document.getElementById('deleteProduct');
deleteProductButton.onclick = () => {
    let productId = deleteProductButton.dataset.productid;
    document.getElementById('modalDeleteButton').href = `/admin/deleteProduct?id=${productId}`;
}

async function getProduct(id) {
    const data = new FormData();
    data.append('productId', id);
    let response = await fetch('/admin/getProduct', {
        method: 'POST',
        body: data
    })
    return response.json();
}

