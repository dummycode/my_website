import { getAccessToken } from './utils'

const baseUrl = 'http://localhost:3000'

const getContacts = function(successHandler, errorHandler) {
  $.ajax({
    url: baseUrl + '/api/contacts',
    type: 'get',
    data: [],
    beforeSend: function(xhr) {
      xhr.setRequestHeader('x-access-token', getAccessToken())
    },
    success: function(response) {
      successHandler(response.content.data)
    },
    error: errorHandler,
  })
}

const getGroups = function(successHandler, errorHandler) {
  $.ajax({
    url: baseUrl + '/api/groups',
    type: 'get',
    data: [],
    beforeSend: function(xhr) {
      xhr.setRequestHeader('x-access-token', getAccessToken())
    },
    success: function(response) {
      successHandler(response.content.data)
    },
    error: errorHandler,
  })
}

const getMessages = function(successHandler, errorHandler) {
  $.ajax({
    url: baseUrl + '/api/messages',
    type: 'get',
    data: [],
    beforeSend: function(xhr) {
      xhr.setRequestHeader('x-access-token', getAccessToken())
    },
    success: function(response) {
      successHandler(response.content.data)
    },
    error: errorHandler,
  })
}


export {
  getContacts,
  getGroups,
  getMessages,
}

