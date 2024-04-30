loadNode()

function loadNode() {
    fetch('/api/nodes/' + window.location.pathname.split('/').pop())
        .then(response => response.json())
        .then(node => {
            console.log(node)
            document.getElementById('alias').value = node.alias
            document.getElementById('description').innerText = node.description
            // document.getElementById('node-description').innerText = node.description
            // document.getElementById('node-status').innerText = node.status
            // document.getElementById('node-createdAt').innerText = node.createdAt
            // document.getElementById('node-updatedAt').innerText = node.updatedAt
        })
        .catch(error => console.error(error))
}