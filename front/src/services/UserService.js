import jwtDecode from "jwt-decode";
import {basePath} from "./basePath";

const API_URL = basePath + '/users';

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

const UserService = {
  getUser,
  logout
}

export default UserService;
