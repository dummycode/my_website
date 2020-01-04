const getAccessToken = function() {
  return window.sessionStorage.token // TODO this is not secure
}

export {
  getAccessToken,
}

