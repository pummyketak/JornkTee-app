<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $bankaccount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bankaccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bankaccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bankaccount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bankaccount whereBankaccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bankaccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bankaccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bankaccount whereUpdatedAt($value)
 */
	class Bankaccount extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $plan_number
 * @property string $eventstart_date
 * @property string $eventend_date
 * @property string|null $detail
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $admins
 * @property-read int|null $admins_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Storelayout> $storelayouts
 * @property-read int|null $storelayouts_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\EventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEventendDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEventstartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event wherePlanNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereUpdatedAt($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $image_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereUpdatedAt($value)
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $areanumber
 * @property int $price
 * @property int $status
 * @property string|null $comment
 * @property int $useridbooking
 * @property string $nameuserbooking
 * @property string $storedetail
 * @property string $start_date
 * @property string $end_date
 * @property int $confirmbooking
 * @property string|null $image_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $event_id
 * @property-read \App\Models\Event|null $event
 * @method static \Database\Factories\StorelayoutFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereAreanumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereConfirmbooking($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereNameuserbooking($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereStoredetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Storelayout whereUseridbooking($value)
 */
	class Storelayout extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $managedEvents
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $type
 * @property int|null $areaid
 * @property string|null $userstoredetail
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $managed_events_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAreaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUserstoredetail($value)
 */
	class User extends \Eloquent {}
}

