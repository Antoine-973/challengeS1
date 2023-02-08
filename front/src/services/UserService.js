import jwtDecode from "jwt-decode";

const API_URL = 'https://localhost/users';

const UserService = () => {

  const getUser = () => {
    const token = localStorage.getItem('token');
    const id = jwtDecode(token).id;

    return fetch(API_URL + '/' + id,
      {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
      })
      .then(response => response.json())
      .then(data => data)
      .catch(error => error);
  }

  return {
    getUser,
  }
}

export default UserService;
