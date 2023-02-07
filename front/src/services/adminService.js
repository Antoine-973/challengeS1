import {basePath} from "./basePath";
const path = basePath + 'reviews' ;
const pathReviews = basePath + 'reviews/';
const pathUser = basePath + 'users/';


export const getAllReviews = async () => {
    return await fetch(path, {

    });
};

export const getReviewById = async (id) => {
    return await fetch(pathReviews + id, {

    });
};


export const RefuseReview = async (id) => {

    return await fetch(pathReviews + id, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/merge-patch+json',
      },
      body: JSON.stringify({
        isValidate: false
      })
    });
}

export const ValidateReview = async (id) => {
    return await fetch(pathReviews + id, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/merge-patch+json',
        },
        body: JSON.stringify({
            isValidate: true
        })
    })
}

export const BanUser = async (id) => {
    return await fetch(pathUser + id, {
        method: 'PATCH',
        headers:{
            'Content-Type': 'application/merge-patch+json',
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