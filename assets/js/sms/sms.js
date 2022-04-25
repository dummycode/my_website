import { getUrlParameter } from '../utils/url'
import { getGroups, getContacts, getMessages } from './api'
import { getAccessToken } from './utils'

const baseUrl = 'http://localhost:3000'

if (
  window.location.pathname.startsWith('/projects/sms') &&
  window.location.pathname !== '/projects/sms/login/' &&
  window.sessionStorage.token === undefined
) {
  window.location.replace(
    '/projects/sms/login?target=' + window.location.pathname,
  )
} else if (
  window.location.pathname === '/projects/sms/login/' &&
  window.sessionStorage.token !== undefined
) {
  window.location.replace('/projects/sms/')
}

$(function() {
  $('#sms__form').submit(function() {
    $('#sms__form')
      .find('input[type=submit]')
      .prop('disabled', true)
    sendMessage()
    return false
  })

  $('#sms__form--contact').submit(function() {
    $('#sms__form--contact')
      .find('input[type=submit]')
      .prop('disabled', true)
    createContact()
    return false
  })

  $('#sms__form--group').submit(function() {
    $('#sms__form--group')
      .find('input[type=submit]')
      .prop('disabled', true)
    createGroup()
    return false
  })

  $('.sms__message-field').prop('maxlength', '160')
  $('.sms__message-field').bind('input propertychange', function() {
    $('#sms__message-field-count').text(
      `${$('.sms__message-field').val().length}/160`,
    )
  })

  $('#sms__form--login').submit(function() {
    $('#sms__form--login')
      .find('input[type=submit]')
      .prop('disabled', true)
    login()
    return false
  })

  // Populate groups dropdown
  if ($('.sms-group-select').length) {
    populateGroupsSelector()
  }

  // Populate contact list
  if ($('.sms-contacts__list').length) {
    populateContactsTable()
  }

  // Populate groups list
  if ($('.sms-groups__list').length) {
    populateGroupsTable()
  }

  // Populate messages table
  if ($('.sms-messages__table').length) {
    populateMessagesTable()
  }
})

function populateContactsTable() {
  const successHandler = function(contacts) {
    $('#sms-contacts__loading').hide()

    if (contacts.length === 0) {
      $('.sms-contacts__list').hide()
      $('.sms-contacts__list').before(
        $('<p class="sms-contacts__list--none">').text('No contacts found'),
      )
    }

    contacts.forEach(function(contact) {
      const newContactListItem = renderContactListItem(contact)

      $('.sms-contacts__list').append(newContactListItem)
    })
  }

  const errorHandler = function(response) {
    $('#sms-contacts__loading').hide()
    if (response.status === 0) {
      $('.sms-contacts__list').after(
        $('<p>').text('Failed to connect to server'),
      )
    } else {
      $('.sms-contacts__list').after(
        $('<p>').text(
          'Failed to fetch contacts: ' + response.responseJSON.content.message,
        ),
      )
    }
  }

  getContacts(successHandler, errorHandler)
}

function populateGroupsSelector() {
  const successHandler = function(groups) {
    $('.sms-group-select')
      .find('option')
      .remove()
    $('.sms-group-select').append(
      $('<option>')
        .attr('value', null)
        .text('All groups'),
    )

    groups.forEach((group) => {
      $('.sms-group-select').append(
        $('<option>')
          .attr('value', group.id)
          .text(group.name),
      )
    })
  }

  const errorHandler = function(response) {
    console.log('Got nothing', response)
  }

  getGroups(successHandler, errorHandler)
}

function populateGroupsTable() {
  const successHandler = function(groups) {
    $('#sms-groups__loading').hide()

    if (groups.length === 0) {
      $('.sms-groups__list').hide()
      $('.sms-groups__list').before(
        $('<p class="sms-groups__list--none">').text('No groups found'),
      )
    }

    groups.forEach(function(group) {
      const newGroupListItem = renderGroupListItem(group)

      $('.sms-groups__list').append(newGroupListItem)
    })
  }

  const errorHandler = function(response) {
    $('#sms-groups__loading').hide()
    if (response.status === 0) {
      $('.sms-groups__list').after($('<p>').text('Failed to connect to server'))
    } else {
      $('.sms-groups__list').after(
        $('<p>').text(
          'Failed to fetch groups: ' + response.responseJSON.content.message,
        ),
      )
    }
  }

  getGroups(successHandler, errorHandler)
}

// TODO generalize
function populateMessagesTable() {
  const successHandler = function(messages) {
    $('#sms-messages__loading').hide()

    if (messages.length === 0) {
      console.log(messages)
      $('.sms-messages__table').replaceWith($('<p>').text('No contacts found'))
    }

    messages.forEach(function(message) {
      const newMessageRow = renderMessageRow(message)

      $('.sms-messages__table').append(newMessageRow)
    })
  }
  const errorHandler = function(response) {
    $('#sms-messages__loading').hide()
    if (response.status === 0) {
      $('.sms-messages__table').after(
        $('<p>').text('Failed to connect to server'),
      )
    } else {
      $('.sms-messages__table').after(
        $('<p>').text(
          'Failed to fetch messages: ' + response.responseJSON.content.message,
        ),
      )
    }
  }

  getMessages(successHandler, errorHandler)
}

function sendMessage() {
  $.ajax({
    url: baseUrl + '/api/messages',
    type: 'post',
    data: $('#sms__form').serialize(),
    beforeSend: function(xhr) {
      xhr.setRequestHeader('x-access-token', getAccessToken())
    },
    success: function() {
      $('.sms__form-result')
        .text('Successfully sent message')
        .show()
      $('#sms__form')
        .find('input[type=text], textarea')
        .val('')
      $('#sms__message-field-count').text('0/160')
      $('#sms__form')
        .find('input[type=submit]')
        .prop('disabled', false)
      setTimeout(function() {
        $('.sms__form-result').hide()
      }, 5000)
    },
    error: function() {
      $('.sms__form-result')
        .text('Failed to send message')
        .show()
      $('#sms__form')
        .find('input[type=submit]')
        .prop('disabled', false)
    },
  })
}

function createContact() {
  $.ajax({
    url: baseUrl + '/api/contacts',
    type: 'post',
    data: $('#sms__form--contact').serialize(),
    beforeSend: function(xhr) {
      xhr.setRequestHeader('x-access-token', getAccessToken())
    },
    success: function(response) {
      const contact = response.content.data

      const newContactListItem = renderContactListItem(contact)
      $('.sms-contacts__list--none').hide()
      $('.sms-contacts__list').show()
      $('.sms-contacts__list').prepend(newContactListItem)

      $('#sms__form--contact')
        .find('input[type=text], textarea')
        .val('')
      $('#sms__form--contact')
        .find('input[type=submit]')
        .prop('disabled', false)

      $('.sms-contacts__list').prepend()
    },
    error: function(response) {
      if (response.status === 0) {
        $('.sms__form-result')
          .text('Failed to connect to server')
          .show()
      } else {
        $('.sms__form-result')
          .text(
            'Failed to create contact: ' +
              response.responseJSON.content.message,
          )
          .show()
      }
      $('#sms__form--contact')
        .find('input[type=submit]')
        .prop('disabled', false)
    },
  })
}

function login() {
  $.ajax({
    url: baseUrl + '/api/login',
    type: 'post',
    data: $('#sms__form--login').serialize(),
    success: function(response) {
      window.sessionStorage.token = response.content.data.token
      window.location.replace(getUrlParameter('target') || '/projects/sms')
    },
    error: function(response) {
      if (response.status === 0) {
        $('.sms__form-result')
          .text('Failed to connect to server')
          .show()
      } else {
        $('.sms__form-result')
          .text('Failed to login: ' + response.responseJSON.content.message)
          .show()
      }
      $('#sms__form--login')
        .find('input[type=submit]')
        .prop('disabled', false)
    },
  })
}

function deleteContactHandler(event) {
  deleteContact(
    $(this)
      .parent()
      .data('id'),
  )
}

function deleteGroupHandler(event) {
  deleteGroup(
    $(this)
      .parent()
      .data('id'),
  )
}

function deleteContact(id) {
  $.ajax({
    url: baseUrl + '/api/contacts/' + id,
    type: 'delete',
    data: [],
    beforeSend: function(xhr) {
      xhr.setRequestHeader('x-access-token', getAccessToken())
    },
    success: function() {
      window.location.replace('/projects/sms/contacts')
    },
    error: function(response) {
      if (response.status === 0) {
        alert('Failed to connect to server')
      } else {
        alert(
          'Failed to delete contact: ' + response.responseJSON.content.message,
        )
      }
    },
  })
}

function deleteGroup(id) {
  $.ajax({
    url: baseUrl + '/api/groups/' + id,
    type: 'delete',
    data: [],
    beforeSend: function(xhr) {
      xhr.setRequestHeader('x-access-token', getAccessToken())
    },
    success: function() {
      window.location.replace('/projects/sms/groups')
    },
    error: function(response) {
      if (response.status === 0) {
        alert('Failed to connect to server')
      } else {
        alert(
          'Failed to delete group: ' + response.responseJSON.content.message,
        )
      }
    },
  })
}

function renderContactListItem(contact) {
  const newListItem = $('<li>').data('id', contact.contact_id)
  const deleteButton = $('<button>')
    .html('Delete')
    .addClass('sms-contacts__remove-button')
    .click(deleteContactHandler)

  newListItem.text(`${contact.name} - ${contact.phone_number}`)
  newListItem.append(deleteButton)

  return newListItem
}

function renderMessageRow(message) {
  const newTableRow = $('<tr>')
  newTableRow.append($('<td>').html(message.content))
  newTableRow.append($('<td>').html(message.username))
  newTableRow.append($('<td>').html(message.created_at))

  return newTableRow
}

function renderGroupListItem(group) {
  const newListItem = $('<li>').data('id', group.group_id)
  const deleteButton = $('<button>')
    .html('Delete')
    .addClass('sms-groups__remove-button')
    .click(deleteGroupHandler)

  newListItem.text(`${group.name}`)
  newListItem.append(deleteButton)

  return newListItem
}

function createGroup() {
  console.log('Create group')
  $.ajax({
    url: baseUrl + '/api/groups',
    type: 'post',
    data: $('#sms__form--group').serialize(),
    beforeSend: function(xhr) {
      xhr.setRequestHeader('x-access-token', getAccessToken())
    },
    success: function(response) {
      const group = response.content.data

      // TODO FIX
      //   const newContactListItem = renderContactListItem(contact);
      //   $(".sms-contacts__list").prepend(newContactListItem);
      //
      //   $("#sms__form--contact")
      //     .find("input[type=text], textarea")
      //     .val("");
      //   $("#sms__form--contact")
      //     .find("input[type=submit]")
      //     .prop("disabled", false);
      //
      //   $(".sms-contacts__list").prepend();
    },
    error: function(response) {
      if (response.status === 0) {
        $('.sms__form-result')
          .text('Failed to connect to server')
          .show()
      } else {
        $('.sms__form-result')
          .text(
            'Failed to create group: ' + response.responseJSON.content.message,
          )
          .show()
      }
      $('#sms__form--contact')
        .find('input[type=submit]')
        .prop('disabled', false)
    },
  })
}

export function logout() {
  window.sessionStorage.removeItem('token')
}
window.logout = logout
