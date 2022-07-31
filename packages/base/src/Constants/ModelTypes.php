<?php

/*
 * @author Ibtisam al-hitteh
 * @Description: This is class for models type constants
 */

namespace drafeef\base\Constants;


final class ModelTypes {

    public const QuestionBankOne = 1 ;

    public const VideosAndCourses = 2 ;
	
	public const NewsAndArticle = 3 ;
	
	public const EBooks = 4 ;
	
	public const RatingPoints = 5 ;
	
	public const FlashCardScreen = 6 ;

    public const LIST = [
        self::QuestionBankOne,
        self::VideosAndCourses,
        self::NewsAndArticle,
        self::EBooks,
        self::RatingPoints,
        self::FlashCardScreen,
    ];

}
