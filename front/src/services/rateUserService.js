import {basePath} from "./basePath";
const pathUser = basePath + 'users/' ;


export const getUserToRate = async (id) => {
    return await fetch(pathUser + id, {
      // headers: {authorization: 'Bearer ' + localStorage.getItem('token')}
    });
};