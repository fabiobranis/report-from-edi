// Upload via AJAX
document.querySelector('#uploadButton').addEventListener('click', function () {
    let data = new FormData()


    data.append('file', document.querySelector('#uploadFile').files[0])

    let request = new XMLHttpRequest()
    request.addEventListener('load', function (e) {
        if (request.status === 200) {
            window.location = `/report/${request.response.report}`
        } else {
            document.querySelector('#errorMessage').innerText = 'Upload Error'
            document.querySelector('#errorMessage').style.display = 'block'
        }
    })

    request.responseType = 'json'
    request.open('post', '/upload')
    request.send(data)
})