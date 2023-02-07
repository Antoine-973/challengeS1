import {basePath} from "./basePath";
const path = basePath + 'reviews' ;
const pathReviews = basePath + 'reviews/'


export const getAllReviews = async () => {
    return await fetch(path, {

    });
};

export const getReviewById = async (id) => {
    return await fetch(pathReviews + id, {

    });
};


export const DeleteReview = async (id) => {

    return await fetch(pathReviews + id, {
      method: 'DELETE',
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