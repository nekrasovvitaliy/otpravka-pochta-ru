<?php
/**
 * @copyright 2013-2024 Nekrasov Vitaliy
 * @license GNU General Public License version 2 or later
 */
namespace Wishbox\SendingRussianPostSDK\Enum;

/**
 * @since 1.0.0
 */
enum MailTypeEnum: string
{
	case POSTAL_PARCEL = 'POSTAL_PARCEL';
	case ONLINE_PARCEL = 'ONLINE_PARCEL';
	case ONLINE_COURIER = 'ONLINE_COURIER';
	case EMS = 'EMS';
	case EMS_OPTIMAL = 'EMS_OPTIMAL';
	case EMS_RT = 'EMS_RT';
	case EMS_TENDER = 'EMS_TENDER';
	case LETTER = 'LETTER';
	case LETTER_CLASS_1 = 'LETTER_CLASS_1';
	case BANDEROL = 'BANDEROL';
	case BUSINESS_COURIER = 'BUSINESS_COURIER';
	case BUSINESS_COURIER_ES = 'BUSINESS_COURIER_ES';
	case PARCEL_CLASS_1 = 'PARCEL_CLASS_1';
	case BANDEROL_CLASS_1 = 'BANDEROL_CLASS_1';
	case VGPO_CLASS_1 = 'VGPO_CLASS_1';
	case SMALL_PACKET = 'SMALL_PACKET';
	case EASY_RETURN = 'EASY_RETURN';
	case VSD = 'VSD';
	case ECOM = 'ECOM';
	case ECOM_MARKETPLACE = 'ECOM_MARKETPLACE';
	case HYPER_CARGO = 'HYPER_CARGO';
	case COMBINED = 'COMBINED';

	/**
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function title(): string
	{
		return match($this)
		{
			MailTypeEnum::POSTAL_PARCEL => 'Посылка "нестандартная"',
			MailTypeEnum::ONLINE_PARCEL => 'Посылка "онлайн"',
			MailTypeEnum::ONLINE_COURIER => 'Курьер "онлайн"',
			MailTypeEnum::EMS => 'Отправление EMS',
			MailTypeEnum::EMS_OPTIMAL => 'EMS оптимальное',
			MailTypeEnum::EMS_RT => 'EMS РТ',
			MailTypeEnum::EMS_TENDER => 'EMS тендер',
			MailTypeEnum::LETTER => 'Письмо',
			MailTypeEnum::LETTER_CLASS_1 => 'Письмо 1-го класса',
			MailTypeEnum::BANDEROL => 'Бандероль',
			MailTypeEnum::BUSINESS_COURIER => 'Бизнес курьер',
			MailTypeEnum::BUSINESS_COURIER_ES => 'Бизнес курьер экпресс',
			MailTypeEnum::PARCEL_CLASS_1 => 'Посылка 1-го класса',
			MailTypeEnum::BANDEROL_CLASS_1 => 'Бандероль 1-го класса',
			MailTypeEnum::VGPO_CLASS_1 => 'ВГПО 1-го класса',
			MailTypeEnum::SMALL_PACKET => 'Мелкий пакет',
			MailTypeEnum::EASY_RETURN => 'Легкий возврат',
			MailTypeEnum::VSD => 'Отправление ВСД',
			MailTypeEnum::ECOM => 'ЕКОМ',
			MailTypeEnum::ECOM_MARKETPLACE => 'ЕКОМ Маркетплейс',
			MailTypeEnum::HYPER_CARGO => 'Доставка день в день',
			MailTypeEnum::COMBINED => 'Комбинированное'
		};
	}
}
