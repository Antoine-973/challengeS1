import jwtDecode from "jwt-decode";

const API_URL = 'https://localhost/users';

const getUser = async () => {
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
    .then(response => {
      if (response.ok) {
        return response.json();
      }
      return Promise.reject(response);
    }
  );
}

const logout = async () => {
  localStorage.removeItem('token');
}

export const editUser = async (user) => {
  return fetch(API_URL + '/' + user.id,{
    method: 'PATCH',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + localStorage.getItem('token'),
    },
    body: JSON.stringify(user)
  }).then(response => response.json()).then(data => data) ;
}

const UserService = {
  getUser,
  logout
}

export default UserService;
