import {basePath} from "./basePath";
const path = basePath + '/reviews' ;
const pathReviews = basePath + '/reviews/';
const pathUser = basePath + '/users/';
const pathBan = basePath + 'api/banUser/'


export const getAllReviews = async () => {
    return fetch(path, {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token'),
      }
    })
      .then(response => response.json())
      .then(data => data);
};

export const getReviewById = async (id) => {
    return fetch(pathReviews + id, {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token'),
      }
    })
      .then(response => response.json())
      .then(data => data);
};


export const RefuseReview = async (id) => {

    return await fetch(pathReviews + id, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/merge-patch+json',
        'Authorization': 'Bearer ' + localStorage.getItem('token'),
      },
    });
}

export const ValidateReview = async (id) => {
    return await fetch(pathReviews + id, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/merge-patch+json',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
        body: JSON.stringify({
            isValidate: true
        })
    })
}

export const BanUser = async (id) => {
    return await fetch(pathBan + id, {
        method: 'PATCH',
        headers:{
            'Content-Type': 'application/merge-patch+json',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
        body: JSON.stringify({
            isBan: true
        })
    })
}

export const GetUser = async (id) => {
    return await fetch(pathUser + id, {
    })
}
